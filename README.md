<p align="center">
  <h2 align="center">API Loterias CAIXA</h2>
  <p align="center">
    API de Resultados das <a href="http://loterias.caixa.gov.br/wps/portal/loterias">Loterias CAIXA</a>.<br>
  </p>
</p>

Apresentamos nossa API gratuita de resultados das Loterias CAIXA!

Com a API, você terá acesso rápido e fácil aos resultados dos jogos das Loterias CAIXA. Fornecemos os números sorteados, valores dos prêmios e quantidade de ganhadores. Tudo isso de forma gratuita para você utilizar em seus aplicativos, sites ou projetos.

essa api foi feita com a intenção de fazer a troca de base de dados para deixar mais robusta e eficaz, por tanto não esta pronta mas estão funcional 

Esta biblioteca web é muito simples que faz a leitura da api do site da Caixa Econômica Federal, podendo parar de responder por alterações na estrutura. Se você identificar um erro de acesso a um dos dados, favor abrir uma issue para solução da mesma.

## Exemplos de Retorno
```
{
    "success": true,
    "code": 200,
    "items": [
        "megasena",
        "lotofacil",
        "quina",
        "lotomania",
        "timemania",
        "duplasena",
        "federal",
        "diadesorte",
        "supersete",
        "maismilionaria"
    ]
}
```
