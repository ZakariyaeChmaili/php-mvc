<?php
require_once "App/core/core.php";

function extractTablesFromEntities(): array
{
    $tables = [];
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(P_ROOT."/App/", RecursiveIteratorIterator::LEAVES_ONLY));
    foreach ($iterator as $file) {
        if (str_ends_with($file->getFilename(), ".php")) {
            $fileName = str_replace(".php", "", $file->getFilename());
            if (class_exists($fileName)) {
                $tableName = $fileName;
                $columns = [];
                $reflection = new ReflectionClass($fileName);
                $reflectionAttributeClass = $reflection->getAttributes(Entity::class);
                if ($reflectionAttributeClass) {
                    foreach ($reflectionAttributeClass as $attribute) {
                        $tableName = $attribute->getArguments()[0];
                    }

                    $arguments = $reflection->getProperties();
                    foreach ($arguments as $argument) {
                        $isIndex = false;
                        if ($argument->getAttributes(Id::class)) {
                            $isIndex = true;
                        };

                        $columnAttribute = $argument->getAttributes(Column::class)[0];
                        $columnAttributeArguments = $columnAttribute->getArguments();

                        $columnName = $columnAttributeArguments[0];
                        $columnType = $columnAttributeArguments[1];


                        $columns[] = [
                            "columnName" => $columnName,
                            "columnType" => $columnType,
                            "isIndex" => $isIndex
                        ];
                    }

                    $tables[] = [
                        "tableName" => $tableName,
                        "columns" => $columns
                    ];
                }

            }

        }
    }
    return $tables;
}


function convertTablesToSqlScripts(array $tables): array
{
    $tablesSqlScripts = [];
    foreach ($tables as $table) {
        $tablesSqlScripts[] = generateSqlFromTable($table);
    }


    return $tablesSqlScripts;
}

function generateSqlFromTable(array $table): string
{
    $sql = "drop table if EXISTS " . $table['tableName'] . "; create table " . $table['tableName'] . " ( ";
    foreach ($table['columns'] as $column) {
        if ($column['isIndex'])
            $sql .= "`" . $column['columnName'] . "` " . convertDataTypeToSqlType($column['columnType']) . "  PRIMARY KEY auto_increment, ";
        else
            $sql .= "`" . $column['columnName'] . "` " . convertDataTypeToSqlType($column['columnType']) . ",";
    }
    $sql = substr($sql, 0, -1);

    $sql .= ");";
    return $sql;
}


function convertDataTypeToSqlType(ColumnTypes $type): string
{
    return match ($type) {
        ColumnTypes::BOOLEAN => "boolean",
        ColumnTypes::FLOAT => "float",
        ColumnTypes::INT => "int",
        default => "text",
    };

}

function executeSqlScripts(array $sqlScripts): void
{
    $connection = Database::getInstance()->getConnection();
    foreach ($sqlScripts as $sqlScript) {
        $connection->exec($sqlScript);
    }
}

$sqlScripts = convertTablesToSqlScripts(extractTablesFromEntities());
executeSqlScripts($sqlScripts);
