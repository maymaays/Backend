# Backend
Using `php` and hand to wrote it. I don't use any external library in this project. 

# To folk
You need to fixed database connection `model/Model.php` first.

# Explanation
1. [api](api) folder - contains some `useful` method and `json parser`
2. [model](model) folder - contains `database` connection
3. [test](test) folder - contains example usage, how to write the frontend and more...
4. main php is name: [senter.php](senter.php)

# To connection
the [senter.php](senter.php) using only `GET` method which parameter `json` only,   <p>
This will receive sql query -> query in database -> sent result back in `json` format

# json format

### Input
```json
{
    "query": "SHOW TABLES"
}
```

### Output
```json
{
    "success": "true|false", 
    "key": "value" // (optional) have when SELECT / SHOW / DESCRIBE / EXPLAIN only
}
```

# Example
In [test/](test) folder
1. [index.html](test/index.html) - example frontend usage
2. [data_testing.php](test/data_testing.php) - example http `GET` method