# AlertaBit

O **CryptoAlert** é uma aplicação Laravel de alta performance desenvolvida para monitorar o preço do Bitcoin em tempo real em diversas corretoras. O sistema permite que usuários configurem limites de preço (teto e piso) e recebam notificações automáticas por e-mail sempre que o mercado atingir esses patamares.

---

## 🚀 Funcionalidades

* **Monitoramento em Tempo Real:** Consumo de APIs externas de diversas exchanges.
* **Autenticação Completa:** Cadastro e login de usuários para gestão de alertas.
* **Alertas Personalizados:** Configuração individual de valores máximos e mínimos por usuário.
* **Automação de E-mails:** Disparo automático de alertas via Jobs agendados.
* **Histórico de Alertas:** Visualização das últimas notificações disparadas no dashboard.

---

## 🛠️ Tecnologias e Ferramentas

* **Framework:** [Laravel](https://laravel.com)
* **Linguagem:** PHP
* **Banco de Dados:** MySQL

---

## 🏗️ Arquitetura e Design Patterns

O projeto foi construído seguindo as melhores práticas de engenharia de software para garantir escalabilidade e facilidade de manutenção:

* **Service Pattern:** Toda a lógica de negócio (cálculos de preço e regras de disparo) está isolada em Services.
* **Repository Pattern:** A abstração do acesso aos dados permite trocar a fonte de dados sem afetar a lógica de negócio.
* **Interfaces:** Utilização de contratos para garantir o desacoplamento entre as camadas.
* **Task Scheduling:** Um **Job** configurado para rodar a cada **10 minutos** processa a fila de e-mails para todos os usuários cujos critérios foram atingidos.
* <img width="1898" height="831" alt="image" src="https://github.com/user-attachments/assets/7043755f-4f2e-4162-b6fe-be88a96f661b" />
<img width="1906" height="860" alt="image" src="https://github.com/user-attachments/assets/c09e9d87-0bf0-46ec-965e-9b9e88cbb5db" />
<img width="1775" height="623" alt="image" src="https://github.com/user-attachments/assets/d627a431-8037-4996-9312-634ace590060" />

