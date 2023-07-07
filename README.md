# Plugin WordPress

### Shortcode e Filters/Hooks

![code2](/docs/code2.png?raw=true)

Plugin Wordpress criado como parte do processo seletivo *Full Stack Developer Splendor.io*.

* Descrição: Escreva um plugin para WordPress com as seguintes funcionalidades:

1. Shortcode `[splendor_fullstack]`

O plugin deverá conter um shortcode que tenha como output o Nome do Usuário logado e a data atual (formatada com dia/mes/ano hora:minutos)

2. Filters/Hooks

Você deverá construir no seu plugin um método que irá criar um método para um filter e adicionar seu código à lista de códigos de pessoas.

nome do filter: `splendor_test`
argumentos do método de callback: `$codigo_pessoas[]: Array`
retorno esperado: o array com o seu código pessoal adicionado ao array.

* Objetivo: Avaliar sua capacidade de construir um plugin de wordpress com uma arquitetura base, avaliar seu conhecimento em shortcodes e filters/hooks.


![code1](/docs/code1.png?raw=true)


### Controlador de WP REST API

* Descrição: Adicione um controlador `wp-json/v2/` ao seu plugin inicial

Ele deverá receber um método POST e validar se o argumento possui o seu código pessoal (do passo 01).

Método: POST
Argumentos da requisicao:
codigo
Permissões: Qualquer usuário – logado ou deslogado
Validação: `$_REQUEST[‘codigo’] == (seu código pessoal)`

Uma vez validado retorne o seguindo objeto json;

```
retorno: {
  status: true,
  data: —> data atual   dia/mes/ano hora:minutos
  codigo: —> seu código pessoal
}
```

Caso o código estiver errado retorno `Erro 403: não autorizado`

* Objetivo: Avaliar seu conhecimento em WP REST Api e construção de controladores de api em WordPress e PHP.

![code4](/docs/code4.png?raw=true)
