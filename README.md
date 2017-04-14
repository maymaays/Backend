# Backend
Using `php` and hand to wrote it. I don't use any external library in this project. 

# To folk
You need to fixed database connection `model/Model.php` first.

## Example 
1. Constants.ini
```ini
; IP address
ssh_host = ""
local_host = ""

; user
root_user = "root"
database_manager = ""

; pass
database_password = ""

; database
database_name = ""

; port
default_sql_port = 3306

```

# Explanation
1. [api](api) folder
    - method_api.php - contains *useful* method
    - json_parser.php - contains parse `query result` to `json`
    - query_api.php - contains provide query method
2. [model](model) folder - contains `database` connection
3. [test](test) folder - contains example usage, how to write the frontend and more...
4. main php is name: [senter.php](index.php) @Deprecated because security problem

# To connection (On develop new security)
> deprecated for security problem.

the [senter.php](index.php) using only `GET` method which parameter `json` only,   <p>
This will receive sql query -> query in database -> sent result back in `json` format

------

Still work on new one.

# json format

### Input (case-sensitive) (On develop for new security)
1. Insert Customer
 ```json
 {
     "action":"insert_customer",
     "id": "id",
     "first": "first name",
     "last": "last name",
     "address": "address",
     "email": "email",
     "password": "md5 encryption"
 }
 ```
 
2. Update Customer
  ```json
  {
      "action":"update_customer",
      "field": "column",
      "value": "new_value",
      "password": "md5 encryption"
  }
  ```
  
3. Search Customer by password
```json
  {
      "action":"search_customer",
      "email": "email",
      "password": "md5 encryption"
  }
```

4. get All Data from table 
```json
  {
      "table": "Hotel|Room|RoomType|Facilities",
      "condition": [
          "id=1001", "id=1002"
      ]
  }
```

### Output
```json
{
    "success": "true|false", 
    "key": "value",
    "failure":"condition"
}
```
**PS.**: `key/value` can be more than 1 and it's will appear iff SELECT / SHOW / DESCRIBE / EXPLAIN was executed (might more than 1).  
**PS.2**: `failure` will happen iff `success=false`

# Example
1. [test/](test) folder - connect front and backend
    1. [index.html](test/index.html) - example frontend usage
    2. [data_testing.php](test/data_testing.php) - example http `GET` method
2. [tester/](tester) - api/http method tester

# Credit
- reader markdown in `index.html` by `display-markdown` ([link](https://github.com/sawmac/display-markdown))
