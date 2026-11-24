# 🏛️ Documentação Técnica: Currículo Modular Moab Lima

Esta documentação detalha as escolhas de arquitetura, padrões de projeto e a lógica de funcionamento da aplicação desenvolvida em Laravel.

---

## 🧩 Arquitetura de Software

A aplicação segue o padrão **MVC (Model-View-Controller)**, com uma implementação focada em **Modularização de Views** e **Injeção de Dados Estáticos**.



### 1. Camada de Controle (`Controller`)
O `CurriculoController` atua como a única fonte de verdade (Single Source of Truth). 
- **Lógica:** Em vez de hardcodar informações no HTML, os dados são estruturados em um array associativo complexo no PHP.
- **Vantagem:** Facilita a manutenção. Para alterar uma skill ou cargo, não é necessário buscar tags HTML, apenas atualizar a estrutura de dados no Controller.

### 2. Camada de Visualização (`Blade Templates`)
A interface foi decomposta utilizando o conceito de **Atomic Design** adaptado ao Blade:

* **Layouts (`layouts/site.blade.php`):** Contém o esqueleto global. Gerencia a importação de bibliotecas externas (Tailwind, FontAwesome, Devicon) e o script crítico de bloqueio de "FOUC" (Flash of Unstyled Content) para o Dark Mode.
* **Partials (`views/partials/`):** Componentes independentes e reutilizáveis.
    * `header.blade.php`: Gerencia estados de UI (Tema e Clipboard).
    * `skills.blade.php`: Implementa lógica de iteração para renderização de ícones dinâmicos.
* **Directives:** Uso intensivo de `@extends`, `@section`, `@include` e `@if/@foreach` para controle de fluxo.

---

## ⚙️ Implementações Técnicas Relevantes

### 🌓 Gestão de Estado de Tema (Dark Mode)
A implementação utiliza uma estratégia híbrida:
1.  **CSS:** Classes utilitárias `dark:` do Tailwind.
2.  **JS LocalStorage:** Persistência de estado para que a escolha do usuário sobreviva ao refresh da página.
3.  **Media Queries:** O script `window.matchMedia('(prefers-color-scheme: dark)')` garante que o site respeite o tema do Windows/Linux/macOS do visitante por padrão.

### 📜 Performance UI: CSS Scroll Snap
Para o carrossel de habilidades, optou-se por **CSS Scroll Snap** em vez de bibliotecas pesadas de JavaScript (como Slick ou Swiper).
- **Resultado:** Performance de 100 pontos no Google PageSpeed, já que o processamento da rolagem é feito nativamente pela GPU do navegador.

### 📋 Clipboard API & Feedback UX
A funcionalidade de cópia de e-mail utiliza a **Async Clipboard API** (`navigator.clipboard.writeText`). A lógica de feedback foi construída com estados temporários no DOM:
- Ao disparar o evento de `click`, o script altera classes do Tailwind para realizar o "swap" de ícones e acionar o `tooltip`, revertendo o estado após 2000ms através de um `setTimeout`.

---

## 🛠️ Stack Tecnológica

| Camada | Tecnologia | Finalidade |
| :--- | :--- | :--- |
| **Engine** | Laravel 10.x | Estruturação e roteamento |
| **Linguagem** | PHP 8.2 | Processamento de dados |
| **Estilização** | Tailwind CSS | Design System e Responsividade |
| **Ícones** | Devicon / FontAwesome | Identidade visual técnica |
| **Client-side** | Vanilla JS | Manipulação de DOM e LocalStorage |

---

## ♿ Acessibilidade e Semântica
O código foi escrito seguindo padrões semânticos:
- Uso de tags `<main>`, `<nav>`, `<footer>` e `<section>`.
- Implementação de `aria-label` e `role="region"` nos componentes de carrossel.
- Gestão de `tabindex` para garantir que o fluxo de navegação via teclado siga a ordem lógica de leitura.

---
## Licença

[MIT](LICENSE)
