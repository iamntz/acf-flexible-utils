This is a plugin that will add some extra goodies on the [ACF](http://advancedcustomfields.com) Flexible Content. You just need to add a class name to representative fields:

- You can specify a title for an element (so if you're using multiple fields that are similar, you can know which is which when they are collapsed): `js-title`
- You can specify a field type (more on that later): `js-layoutType`
- You can disable a box: `js-disableSection`

### Flexible Content Title
Right now, ACF doesn't allow you to set a title for a flexible content item, so when you're using two similar boxes, you don't know which is which when they are collapsed. This will fix it! Just add the `js-title` class on the text fields you want to be used as a title and you're done!

### Field Type?
At some point, I had a project that used a flexible content box which was pretty similar with other flexible content box and the quickest way of dealing with that was to add extra fields and toggle their visibility through conditionals. The next thing? How to tell what kind of box is that collapsed box? Hence this class. You should add the `js-layoutType` class to a `select` and that's that.

### Disable a box completely!
Same project, another issue: how can we disable a box temporary? By using a `true_false` field with `js-disableSection` class! Obviously enough, you should take care of the frontend by yourself!

### Bonus!
You even needed to have a longer description for a field but you don't want that whole text to be always visible? How about a tooltip? Just start your description with a question mark and that's all! Now you have nice tooltips on your fields!