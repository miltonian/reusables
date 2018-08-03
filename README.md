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

#### Hooking Views Up To The Database *(If downloaded from Vibrant)*

Assuming the codebase is already connected to the database, you essentially have two types of content to assign to each view: featured_content and posts

**featured_content** is the default content type. It is content relating directly with the view.

**posts** is the content relating to the posts table. You can add more posts using the “new posts” button in the admin bar. (if you don’t see this then you’re not logged in. We’ll go over that later). The posts will automatically show in the views if posts exist.

#### Adding Content To A View

There are only two steps to make a view editable. 

**Step 1:**
```sh
ViewData::set([identifier], __FILE__, [number of items], [featured_content/posts]));
```
Replace the [identifier] with the identifier of the view you’d like to connect to the database. Replace [number of items] with the number of items that are in the view (for example one table with 3 cells would be 3). if the content type is posts then replace [featured_content/posts] with posts, otherwise this is optional.

**Step 2:**
```sh
[identifier].options(editable: true);
```
**Step 3** *(Optional)*: 

You might want to choose which inputs you use for editing these views. You can do that with this function in between the php tags at the top:
```sh
Reusables\Data::addData([[name_of_input], [name_of_input]], “input_keys”, [identifier]);
```
An example of this in action:
```sh
Reusables\Data::addData([“title”, “subtitle”, “imagepath”, “input_keys”, “product_header”);
```
That’s it!

#### How to Edit Views

- Go to [http://localhost:8888/login](http://localhost:8888/login)
- Login with username: tester, password: asdf
- Navigate to the page you created for this tutorial
- Click on edit in the top right corner of the page
- Click on the view that you made editable in the above example
- Change the content and click submit and it should update that content!


