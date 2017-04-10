# Backend
Using `php` and hand to wrote it. I don't use any external library in this project. 

# To folk
You need to fixed database connection `model/Model.php` first.

# Explanation
1. [api](api) folder
    - method_api.php - contains *useful* method
    - json_parser.php - contains parse `query result` to `json`
    - query_api.php - contains provide query method
2. [model](model) folder - contains `database` connection
3. [test](test) folder - contains example usage, how to write the frontend and more...
4. main php is name: [senter.php](senter.php) @Deprecated because security problem

# To connection (On develop new secure)
> deprecated for security problem.

the [senter.php](senter.php) using only `GET` method which parameter `json` only,   <p>
This will receive sql query -> query in database -> sent result back in `json` format

------

Still work on new one.

# json format

### Input (On develop new secure)
```json
{
    "action":"select|insert|update|delete",
    "table":"value",
    "condition":"id=0|name=someone|...",
    "auth":"NOT IMPLEMENT YET"
}
```

### Output
```json
{
    "success": "true|false", 
    "key": "value"
}
```
**Note**: `key/value` will appear iff SELECT / SHOW / DESCRIBE / EXPLAIN was executed (might more than 1).

# Example
In [test/](test) folder
1. [index.html](test/index.html) - example frontend usage
2. [data_testing.php](test/data_testing.php) - example http `GET` method
