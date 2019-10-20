<?php

namespace Myth\Generators\FactoryGenerator;

use Illuminate\Support\Facades\DB;
use Myth\Generators\Generator;

class FactoryGenerator extends Generator
{
    public function run()
    {
        $this->setUp();
        if ($this->filesystem->exists($path = $this->getPath()) && !$this->force) {
            throw new \Exception($path);
        }

        $this->ensureDirectoryExists($path);


        $class = $this->getOption('model');

        $tableName = (new $class())->getTable();
//        $columns[] = Schema::getColumnListing($tableName);
//        $result = DB::select(DB::raw('select COLUMN_NAME as `column_name`,DATA_TYPE as `data_type` from information_schema.columns where table_schema = ? and table_name = ?')) ;
//        $result = DB::table('information_schema.columns')->where('table_schema', $tableName)
//            ->where('table_schema', config('database.connections.mysql.database'))
//            ->select(['COLUMN_NAME as column_name', 'DATA_TYPE as data_type'])
//            ->get();

//        $tableSchema = config('database.connections.mysql.database');
        $tableSchema = DB::connection('mysql')->getDatabaseName();

        $results = DB::select('select COLUMN_NAME column_name,DATA_TYPE data_type,CHARACTER_MAXIMUM_LENGTH character_maximum_length,IS_NULLABLE is_nullable from information_schema.columns where table_schema = :tableSchema and table_name = :tableName', [
            'tableName' => $tableName,
            'tableSchema' => $tableSchema,
        ]);

        $code = "";
        foreach ($results as $column) {
            if ($column->column_name == 'id') continue;

            if ($column->is_nullable == 'NO') {
                $columnCode = "'" . $column->column_name . "' => ";

                $generationStatement = "\$faker->";

                switch ($column->data_type) {
                    case "int":
                    case "tinyint":
                        $generationStatement .= "randomDigit()";
                        break;
                    case "char":
                    case "varchar":
                        if ($length = $column->character_maximum_length) {
                            $generationStatement = "substr(\$faker->word(), 0, $length )";
                        } else {
                            $generationStatement .= "word()";
                        }
                        break;

                    case "timestamp":
                        $generationStatement = "time()";
                    default:
                        $generationStatement .= "word()";

                }
                $columnCode .= $generationStatement . ',' . PHP_EOL;

                $code .= str_repeat(' ', 10) . $columnCode;
            }

        }

        $template = file_get_contents('DummyFactory.stub');
        $result = str_replace('//TODO', $code, $template);
        $result = str_replace('Dummy', $class, $result);

        echo $result;
        return $this->filesystem->put($path, $result);
    }
}
