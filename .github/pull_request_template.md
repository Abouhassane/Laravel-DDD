## Ticket

<!-- Jira ticket link -->

## Context 

<!-- What I am supposed to do, to fix, etc. (example: I fixed the bug where this and this was happening-->

## What did I do 

<!--- Describe your changes in detail -->

## Screenshots (before/after if appropriate)

<!--- Provide a general summary of your changes in the Title above -->

## API documentation-related pull request

<!--- Add a link to the playplay-docs pull request which contains the documentation impacted by your change -->

## Next steps

## ✈️ On-the-fly environment (WIP)

```yaml
on-the-fly:
  deploy: false # put true here to deploy an env on the-fly
  pause: false # switch your environment to a pause mode
  name: "default" # default = pp-pr-XXXX | this property is immutable, when the environment is created, all changes on the name will be ignored
  apm: false
  prism: false
  processing: "dev"
  rendering: "dev"
  database:
    use: "default" # if you want to use a cloud SQL instance, you can put here `cloud-sql` and fill the connection string like this `playplay-infra:europe-west1:test`
    connection: "" # leave empty for built-in
    database: "" # leave empty for built-in
    username: "" # leave empty for built-in
    password: "" # leave empty for built-in
    backup-file: "latest_e2e.sql"
  functional-tests:
    run: true
    branch: "main"
  #environment-vars:
  #  - name: "ENV_VAR"
  #    value: "test"
  reporter: "default"
```
