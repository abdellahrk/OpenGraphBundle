# Open Graph Bundle 
### Install with Composer 
`composer require abdellahramadan/open-graph-bundle`

## Usage

### Add to template file
Add ```{{ open_graph() }}``` to the base template or any page where the meta information will be injected

### Add meta inforation
In your controller, type-hint `OpenGraphInterface`

### Example
```
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
        return $this-render('index.html.twig');
    }
}
```
This will render
```
<meta property="og:title" content="My website">
<meta property="og:description" content="Some descriptions ...">
<meta property="og:site_name" content="My Blog">
```

#### You can add structured data
``` 
$openGraph->addStructuredProperty('image', 'secure_url', 'https://mysite.com/test.jpg')
```
this will render 

``` 
<meta property="og:image:secure_url" content="https://mysite.com/test.jpg" />
```

### Add Twitter card

```->addTwitterCardProperty('description', 'This is an example X(Twitter) Card```
will render 
```angular2html
<meta name="twitter:description" content="This is an example X(Twitter) Card)" />
```
