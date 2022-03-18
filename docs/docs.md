## Documentation

## Introduction
TODO

### Initial planning
The planning consist of 7 sprints where every sprint is 1 week long. (I'm not using Scrum, but I just use the concept of sprints as parts of the project).  
The projects planning and tasks management is done with Github Issues and Github Projects. [This planning is also available here](https://github.com/samuelroland/galeriz/projects).
![Planning](./img/planning.png)

### MCD
![MCD](MCD.png)
### MLD
![MLD](MLD.png)

## Available pages

- All galleries: under menu section called `Panorama`
- Gallery details: all pictures in the gallery and the name of the author
- Author details: information about the author and a list of the associated categories
- Create a gallery: Create a new gallery without any picture
- Manage gallery's pictures: Upload new pictures, manage titles, delete existing ones and browse current pictures.

## Models
### Layout
![Layout model](models/Layout.png)

### Login
![Login](models/Login.png)

### Register
![Register](models/Register.png)

### All galleries
![salut](models/All_galleries.png)

### Create a gallery
![Create a gallery](models/Create_a_gallery.png)

### Gallery details
![Gallery details](models/Gallery_details.png)

## Tests
This section concerns how Galeriz is tested manually and programmatically. Samuel tests during the development if the features are working in his browser. The main testing part is made with automated tests written with `phpunit` (a php testing framework).

### Where are these tests ?
Everything is in the `tests` folder in the repository. 

### Prerequesite to run tests ?
As defined in the `phpunit.xml`, tests are runned against an in memory sqlite database. Each tests seed the database again (TODO: verify).

This lines at the bottom of `phpunit.xml` (root of the repos), define 2 environment variables. (TODO)
```xml
<env name="DB_DATABASE" value=":memory:"/>
<env name="DB_CONNECTION" value="sqlite"/>
```

### How to run tests ?
I recommend you to setup a shortcut in your IDE to run the tests. I used this keyboard shorcut setting in VSCode to run `php artisan test tests/Feature` on `ctrl+t ctrl+t`
```json
{
    "key": "ctrl+t ctrl+t",
    "command": "workbench.action.terminal.sendSequence",
    "args": {
        "text": "php artisan test tests/Feature\u000D"
    }
}
```