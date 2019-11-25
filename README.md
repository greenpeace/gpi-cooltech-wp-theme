# [Cooltech Theme]



* Project: [github.com/greenpeace/gpi-cooltech-wp-theme](https://github.com/greenpeace/gpi-cooltech-wp-theme/)




## Getting Started with cooltech Blank







## Features



### cooltech


### jQuery + JavaScript


### CSS3
* Bootstrap 4
**bootstrap-ct.scss** overrides bootstrap variables



## Preloaded Functions (functions.php)

### Shortcodes:
**fn** footnotes
 attributes:
 nourl - the footnotes has no url (ex: [fn nourl=1]text[/fn])

**g**  glossary term
attributes:
*to be used if glossary text is different than glossary term*
url - slug of the glossary term
id - id of the glossary term

ex:[g url="ammonia"]Ammonia NH3[/g]

**cooltech_cat** it displays the sectors (air conditioning, etc..) or subsectors in columns.
If logo=1 ([cooltech_cat logo=1]) it displays icons.

### Gutenberg Blocks
All the blocks are developed for the homepage that has full width template, but can be used also in other templates.

**Innerblock** It Puts bootstrap 4 container and can contains other blocks
**Intro** blue big text in the homepage
**Magic numbers** It adds animated numbers. It has already a container (doesn't need innerblock)
**Tabs** It add bootstrap tab by page id. It has already a container (doesn't need innerblock)

### Templates
**home.php** template for the homepage (full width)
**page.php** default template with container and full height image
**page-sidebar-right.php** page with full height image and a right sidebar
**page-simple.php** page without full height image
