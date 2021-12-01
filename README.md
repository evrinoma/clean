#Task
### Brief

It's November, and everyone is planning their holiday vacation. But management is struggling! They need a solution to approve vacation requests while also ensuring that there are still enough employees in the office to achieve end-of-year goals.

Your task is to build one HTTP API that allows employees to make vacation requests, and another that provides managers with an overview of all vacation requests and allows them to decline or approve requests.

### Tasks

- Implement assignment using:
    - Language: PHP
    - Framework: Symfony
- There should be API routes that allow workers to:
    - See their requests
        - Filter by status (approved, pending, rejected)
    - See their number of remaining vacation days
    - Make a new request if they have not exhausted their total limit (30 per year)
- There should be API routes that allow managers to:
    - See an overview of all requests
        - Filter by pending and approved
    - See an overview for each individual employee
    - See an overview of overlapping requests
    - Process an individual request and either approve or reject it
- Write tests for your business logic

Each request should, at minimum, have the following signature:
```
{
  "id": ENTITY_ID,
  "author": WORKER_ID,
  "status": STATUS_OPTION, // may be one of: "approved", "rejected", "pending"
  "resolved_by": MANAGER_ID,
  "request_created_at": "2020-08-09T12:57:13.506Z",
  "vacation_start_date" "2020-08-24T00:00:00.000Z",
  "vacation_end_date" "2020-09-04T00:00:00.000Z",
}
```
You are expected to design any other required models and routes for your API.

### Evaluation Criteria

- PHP best practices
- Completeness: Did you include all features?
- Correctness: Does the solution perform in a logical way?
- Maintainability: Is the solution written in a clean, maintainable way?
- Testing: Has the solution been adequately tested?
- Documentation: Is the API well-documented?

### CodeSubmit

Please organize, design, test, and document your code as if it were going into production - then push your changes to the master branch. After you have pushed your code, you must submit the assignment via the assignment page.

All the best and happy coding,

The Sario Marketing GmbH Team


#Debug
ssh -R 9003:172.20.8.178:9003 root@php80.clean

export XDEBUG_CONFIG="mode=debug client_host=172.28.1.243 client_port=9003 start_with_request=yes"

cd /opt/WWW/container.ite-ng.ru/projects/nginx/clean.php80/

#Test
/usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap tests/bootstrap.php --configuration phpunit.xml.dist tests/Functional/Controller/

