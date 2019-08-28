# Flat File CMS Forms module

This is a module for [Flat File CMS](https://github.com/roelofjan-elsinga/flat-file-cms) (running Laravel) to generate forms from simple JSON configurations.

## Installation

You can include this package by requiring it through Composer.
```bash
composer require roelofjan-elsinga/flat-file-cms-forms
```

## Requirements

- php >= 7.2
- Laravel
- roelofjan-elsinga/flat-file-cms

## Configuration

By default, the configurations for forms are placed at ``resources/content/forms``. You can customize this by publishing the config file by running:
```bash
php artisan vendor:publish --provider="FlatFileCms\\Forms\\ServiceProvider"
```

This will place ``flatfilecms-forms.php`` in your config folder.

## Usage

You can include forms in Blade files by calling FlatForm::get('form-name') in your templates:

```blade
{!! FlatForm::get('form-name') !!}
```

If you want to include a form in a page that's managed through [Flat File CMS](https://github.com/roelofjan-elsinga/flat-file-cms) then you can call ``{{form:form-name}}`` in your HTML or Markdown files.

## Testing

You can run tests by running ``./vendor/bin/phpunit``.
