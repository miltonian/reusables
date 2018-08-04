# Reusables

### Setting Up
- In terminal, go to your project's root directory
- Enter: composer require miltonian/reusables
- After that loads cd to the miltonian/reusables directory
- Enter: sh prepare_reusables.sh 

### Creating a WebPage

Add your start and end functions:

```sh
<?php

Reusables\Page::start(true);

/* Add the code for hooking views up to the database here */

?>

<!-- Your code goes here -->

<?php 
Reusables\Page::end(__FILE__);

```

### View Layout

In between the start and end functions, you can start adding views. 

There are 3 main elements when adding views. Type, View, Identifier. The Type is essentially a category of a view. These can be preceded with “custom/” to indicate a custom type and view. The View indicates the specific look of the view. The Identifier must be unique as it defines a specific view on the page and allows you to add options and data to it. We’ll go over that more later. 

In order for Vibrant to find the views you add you must place them in between two double brackets:

```sh
{{
views goes here
}}
```
The format for which the views are based on includes the identifier, type, and view. Remember to add a semicolon at the end of each line:

```sh
[identifier].view([type]/[view]);
```

An example of this in action (identifier=“featured_image”, type=“custom/section”, view=“imagetext_full”):

```sh
{{
featured_image.view(custom/section/imagetext_full);
}}
```

**Types**

- button
- custom/footer
- header
- input
- nav
- custom/section
- table

#### Adding Data 

The format for adding data:

```sh
[identifier].data([key]: [value]);
```

Most of the views will have the same keys: title, subtitle, description, imagepath

An example of this in action:
```sh
{{
about_us_section.data(title: “Value”, subtitle: “Value”, description: “Value”, imagepath: “Value”);
}}
```
#### Adding Options

The format for adding options: 
```sh
[identifier].options([key]: [value]);
```
Most of the views will have the same options: height, reverse, text_color, background_color, image_size, image_corner_radius, text_align, dark

Some examples of this in action:

```sh
{{
about_us_section.options(height: 50%, text_color: red);
article_header.options(reverse: true, background_color: #ffffff);
}}
```

[Make your first webpage with Reusables](https://github.com/miltonian/reusables/wiki/Basic-WebPage-Example)


