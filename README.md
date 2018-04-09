# Installation guide
I assume that docker is running, up to date and ```docker-compose``` command available globally on your machine  
1. Clone repository via:  
  SSH ```git clone git@github.com:lebedyncrs/calendar-graphql-api.git``` or  
  HTTPS ```git clone https://github.com/lebedyncrs/calendar-graphql-api.git```
2. Run ```app/build.sh``` script in your terminal
3. Open [https://goo.gl/oFS7cu](https://goo.gl/oFS7cu) in your browser
4. Run ```logIn``` query. It will save auth token automatically and explore GraphQL API :)


# Design And Concepts
Mainly this app based on MVC architecture with a few extra layers(Repository, Service)

**Timezone handling**  
We store UTC date in DB and depends on user timezone or event setting, we adjust timezone of date

**Model in this app stands for**  
The model is responsible to manage the data,  
it stores and retrieves entities used by an application, usually from a database. 

**Repository in this app stands for**  
Repository is a common wrapper for the model and is where you call DB queries to the database which are defined in Model as scopes. Repository is way to encapsulate data engine, there should be zero SQL. All SQL stuff should handle Data Engine.

**Service in this app stands for**   
Service contains the business logic. It's a place where Repositiries are injected and other dependencies which are required to process task.

**GraphQl Controller in this app stands for**  
GraphQl Controller is place where necessary response is formed. It has only related Service as a dependency.
It interacts with repository but just via Service dependency only. Validation rules and accepted attributes from client are defined here as well


**Why GraphQL?**  
* Simplify relational logic
* Allows to optimize your queries to DB
* Allows to do advanced relational queries
* Get many resources in a single request
* Ask for what you need, get exactly that

GraphQL it's a great way to build complex API.  
In old good REST API is actually quite hard to return exactly data what client need, especially nested objects. 
It's not easy to implement good query language for client. 
GraphQL is a query language for your API which solves problems of REST API


# Testing
**API tests**  
I didn't implement tests for all entities as rest of test will be almost the same.  

I am testing only JSON response result as it's fast and convenient way to test JSON API.
Each test has own DB data to make sure that other test can't have any influence.   
Cool reasons of having isolated tests:
1. Other tests have no influence, by chaning one test you are sure that it doesn't break the rest of tests  
2. Easy to read and debug 
3. Ability to run them in parallel

**What Mutation Test Should Verify**
1. Un authenticated user can perform action or not.
2. Validation errors
3. Successful operation result. Result is a JSON, each JSON key have to have proper data type and make sure that result has proper general structure  

**What Query Test Should Verify**
1. Un authenticated user can perform action or not.
2. Successful operation result. Result is a JSON, each JSON key have to have proper data type and make sure that result has proper general structure

**Unit tests**  
Those kind of tests implemented for timezone handling