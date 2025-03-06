## Usage

### Add the template tag
Add ```{{ open_graph() }}``` to the base template or any page where the meta information will be injected


### Configuration
You can set some default values under `config/packages/open_graph.yaml`
```yaml
open_graph:
  default_og:
      title: Default title
      description: Default description for all pages
      url: https://my-og.com
      sitename: Default website name
```

### Add meta inforation
In your controller, type-hint `OpenGraphInterface`

### Example
```php
class HomeController extends AbstractController
{
    public function index(OpenGraphInterface $openGraph): Response
    {
        $openGraph
            ->setTitle('My website')
            ->setDescription('Some descriptions ...')
            ->setSiteName('My Blog')
        ;
            ...
        return $this->render('index.html.twig');
    }
}
```
This will render
```html
<meta property="og:title" content="My website">
<meta property="og:description" content="Some descriptions ...">
<meta property="og:site_name" content="My Blog">
```

#### You can add structured data
```php
$openGraph->addStructuredProperty('image', 'secure_url', 'https://mysite.com/test.jpg')
```
this will render

```html
<meta property="og:image:secure_url" content="https://mysite.com/test.jpg" />
```

### Add Twitter card

```php
$openGraph->addTwitterCardProperty('description', 'This is an example X(Twitter) Card
```
will render
```html
<meta name="twitter:description" content="This is an example X(Twitter) Card)" />
```

