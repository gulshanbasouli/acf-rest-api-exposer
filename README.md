# ACF REST API Exposer

A lightweight WordPress plugin that exposes **Advanced Custom Fields (ACF)** data for all public custom post types and standard posts via the **WordPress REST API**.

ACF fields are returned under the `ACF` object in every REST API response.

---

## ✨ Features

- Automatically exposes ACF fields for **all custom post types**
- Also includes the standard **`post`** post type
- Excludes internal ACF post types (`acf-field-group`, `acf-field`)
- Zero configuration required — install and activate
- Easily customisable via two simple arrays

---

## 📦 Installation

1. Download or clone this repository
2. Upload the `acf-rest-api-exposer` folder to `/wp-content/plugins/`
3. Activate the plugin from **WordPress Admin → Plugins**
4. That's it — ACF fields will now appear in REST API responses

---

## 🔌 Usage

After activation, make a REST API request to any supported post type:

```
GET /wp-json/wp/v2/posts/123
GET /wp-json/wp/v2/your-custom-post-type/456
```

The response will include an `ACF` object:

```json
{
  "id": 123,
  "title": { "rendered": "My Post" },
  "ACF": {
    "my_custom_field": "Hello World",
    "another_field": "Some Value"
  }
}
```

---

## ⚙️ Customisation

Open `acf-rest-api-exposer.php` and edit these two arrays:

```php
// Post types to EXCLUDE
$postypes_to_exclude = [ 'acf-field-group', 'acf-field' ];

// Extra built-in post types to INCLUDE
$extra_postypes_to_include = [ 'post' ];
```

For example, to also include the `page` post type:

```php
$extra_postypes_to_include = [ 'post', 'page' ];
```

---

## 📋 Requirements

| Requirement     | Version  |
|-----------------|----------|
| WordPress       | 5.0+     |
| PHP             | 7.4+     |
| ACF (Free/Pro)  | 5.0+     |

---

## 🗂️ File Structure

```
acf-rest-api-exposer/
├── acf-rest-api-exposer.php   # Main plugin file
├── README.md                  # Documentation
├── LICENSE                    # MIT License
└── .gitignore                 # Git ignore rules
```

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## 👤 Author

**Gulshan Chauhan**
- GitHub: [@gulshanbasouli](https://github.com/gulshanbasouli)
```
