# Ventriloquist
[![Build Status](https://travis-ci.org/AmadeusDelfino/ventriloquist.svg?branch=master)](https://travis-ci.org/AmadeusDelfino/ventriloquist)

Suporte para fornecer uma interface única para consultas no banco de dados que utilizam ORMs com suporte a dotnotation
(como o Eloquent)

## Exemplo de uso
```json
{
	"values": [
	  {
	    "name": "name"
	  },
	  {
	    "name": "last_name"
	  },
	  {
	    "name": "salary"
	  },
	  {
	    "name": "email"
	  }, 
	  {
	    "name": "vacation",
	    "select": [
	      "id",
	      "start_date",
	      {
	        "name": "allowance",
	        "select": [
	          "id"
	        ]
	      }
	    ]
	  }
    ]
}
```
Como o Ventriloquist foi desenvolvido orientado a microserviços que utilizam mensageria (de forma reativa), eis um 
exemplo de utilização em JSON, considerando que o padrão de mensagens utilizado seja JSON.

Um array PHP que vai gerar um JSON dessa forma é o seguinte:
```php
  array (
    0 => 
    array (
      'name' => 'name',
    ),
    1 => 
    array (
      'name' => 'last_name',
    ),
    2 => 
    array (
      'name' => 'salary',
    ),
    3 => 
    array (
      'name' => 'email',
    ),
    4 => 
    array (
      'name' => 'vacation',
      'select' => 
      array (
        0 => 'id',
        1 => 'start_date',
        2 => 
        array (
          'name' => 'allowance',
          'select' => 
          array (
            0 => 'id',
          ),
        ),
      ),
    )
```

#### Implementação
```php
$parser = new \App\Support\SmartQueryGenerator\QueryParser\Parser();
$parser->query($arrayQuery);
$parser->rootModel(new \My\Root\Model());
$parsed = $parser->parse();

return $parsed->eloquentBuilder()->limit(10)->get();
```
