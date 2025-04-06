DB_PARAMS = {
    "dbname": 'db1',
    "user": 'postgres',
    "password": 'postaaAA11##',
    "host": 'localhost',
    "port": '5432'
}

TABLE_NAME_1 = "forest_fires"

TABLE_NAME_2 = "winequality_red"

TYPE_MEANING = {
    "int64": "INTEGER",
    "float64": "REAL",
    "object": "TEXT",
    "bool": "BOOLEAN",
    "datetime64[ns]": "TIMESTAMP"
}

CSV_PATH_1 = ".\\U4_Bases_de_datos\\forest_fires\\static\\csv\\forestfires.csv"

CSV_PATH_2 = ".\\U4_Bases_de_datos\\forest_fires\\static\\csv\\winequality_red.csv"

CONSULTS = {
    "OR 1":"ph < 3.0 OR ph > 3.8",
    "OR 2":"residual_sugar > 5 OR alcohol > 12",
    "OR 3":"quality < 5 OR alcohol < 9",
    "AND 1":"alcohol > 11 AND quality >= 7",
    "AND 2":"residual_sugar < 2 AND density < 0.995",
    "AND 3":"total_sulfur_dioxide < 50 AND quality > 6",
    "MIX 1":"quality >= 7 AND (ph < 3.2 OR residual_sugar < 2)",
    "MIX 2":"alcohol > 11 AND (volatile_acidity > 0.9 OR chlorides > 0.08)",
    "MIX 3":"quality < 5 AND (density > 1.000 OR citric_acid < 0.1)"
}