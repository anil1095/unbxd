As i tried to analyse the CSV file, the part of data that is common for a product with different models is 
ProductID, MovieTitle, Store, Category, SubCategory.

So I have split the data between 2 tables (Product and Product_models).
Product table (INNODB) contains the following as columns
  1. Product_id (type: int(6), Primary Key)
  2. Name (type: varchar(250))
  3. store (type: varchar(45))
  4. cat_id (type: int(6))

Product_models (MyISM) has the following as columns
  1. product_id (type: int(6), primary key)
  2. model_id (type: int(6), primary key, auto increment)
  3. price (type: int(7))
  4. shipping_duration (type: int(2))
  
For storing both Category and subcategory, I chose a single table named Category (INNODB) with an extra column as Parent_id. Its structure is as below
  1. cat_id (type: int(6), primary key)
  2. cat_name (type: varchar(40))
  3. parent_id (type: int(6), primary key)
  4. deleted (type: tinyint(1))

The purpose of choosing a single table for storing category and its subcategory is to reduce another table. The relations between
any 2 categories can be mainted by simply assinging cat\_id of parent to parent\_id value of subcategory.

I choose MyISM db for product\_models with a combination of model\_id with auto\_increment and product\_id as primary key
so that there is no need to read the number of already existing models for a given product to calculate model\_id for next insert on same product.

I choose codeigniter as a framework just because I work on it daily.
The default controller is _welcome_ controller where the complete business logic code is available.
Views are available in *application/views*.
Database interactions for inserts are done using models which are found in *application/models*.

CSV file is placed in *temp* folder at root level along with MySQL schema creation file (*unbxd schema.sql*).

Dependencies: 
  1. Please use *unbxd schema.sql* to create database.
  2. Please set appropriate values for database connection in *application/config/database.php*.
  3. To upload data from csv file into respective database please access *localhost/unbxd/welcome/saveUploadedFile*.
  4. Please enable *rewrite_module* for apache.
  5. *localhost/unbxd* to search for products.
