# Aeroportos API

Uma API RESTful feita com Laravel contendo dados de aeroportos, aeroclubes e bases aéreas nacionais com o código IATA como chave principal. Contém nome, latitude e longitude em graus decimais, altitude em metros, cidade, UF (nome e sigla), códigos IATA e ICAO e identificador de fuso horário.

<div align="center">
    <a href="https://vercel.com/">
        <img src="./public/powered-by-vercel.svg" width="175" alt="Powered by Vercel">
    </a>
</div>

## Licença

Este projeto está sob a licença do [MIT](https://opensource.org/licenses/MIT).

## Dados
Os dados provém [deste repositório](https://github.com/mwgg/Airports), sendo filtrados apenas os aeroportos brasileiros que possuem um código IATA válido e traduzindo o nome dos aeroportos para o português.
