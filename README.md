# pweb-av02-printLabs

Este repositório contém o projeto de estudo do curso **Técnico em Desenvolvimento de Sistemas**, cujo **objetivo geral** é desenvolver um sistema web utilizando **PHP (PDO e Programação Orientada a Objetos)** com banco de dados **MySQL** (via Laragon), aplicando os conceitos de **CRUD**, **autenticação**, **organização de código** e **layout profissional**. Além disso, este projeto visa praticar fluxos de versionamento e colaboração usando **Git** e **GitHub**.

---

## 📑 Sumário

1. [Tecnologias Utilizadas](#tecnologias-utilizadas)  
2. [Pré-requisitos](#pré-requisitos)  
3. [Clonar o Repositório](#clonar-o-repositório)  
4. [Instalar Dependências](#instalar-dependências)  
5. [Fluxo de Contribuição](#fluxo-de-contribuição)  
6. [Abrir Pull Request](#abrir-pull-request)  

---

## 🛠️ Tecnologias Utilizadas

- **Linguagem:** PHP (PDO, OOP)  
- **Banco de Dados:** MySQL (via Laragon)  
- **Servidor Local:** Laragon  
- **Versionamento:** Git / GitHub  

---

## ⚙️ Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- [Git](https://git-scm.com/)  
- [Laragon](https://laragon.org/)  
- [PHP](https://www.php.net/)  

---

## 📥 Clonar o Repositório

1. Abra o terminal e navegue até o diretório onde deseja armazenar o projeto.  
2. Clone o repositório:  
    ```bash
    git clone https://github.com/SEU-USUARIO/pweb-av02-printLabs.git
    ```  
3. Entre na pasta do projeto:  
    ```bash
    cd pweb-av02-printLabs
    ```

---

## 💾 Instalar Dependências

Como o projeto é em PHP e utiliza MySQL, não há dependências via npm ou composer:

1. Copie a pasta `pweb-av02-printLabs` para `C:/laragon/www/`.  
2. Abra o Laragon e inicie **Apache** e **MySQL**.  
3. Acesse o **phpMyAdmin** e importe o script em `database/schema.sql` para criar o banco de dados.  

---

## 🔄 Fluxo de Contribuição

1. **Partir da branch `dev`:**  
 ```bash
 git checkout dev
 git pull origin dev
 ```  
2. **Criar uma branch de feature:**  
 ```bash
 git checkout -b feature/nome-da-sua-feature
 ```  
3. **Desenvolver e testar** na sua branch.  
4. **Commitar alterações:**  
 ```bash
 git add .
 git commit -m "[feature] Descrição curta da feature"
 ```  
5. **Enviar para o remoto:**  
 ```bash
 git push origin feature/nome-da-sua-feature
 ```

---

## 🚀 Abrir Pull Request

1. Acesse o repositório no GitHub.  
2. Clique em **Compare & Pull Request** ao lado da sua branch.  
3. Preencha **título** e **descrição** detalhando suas alterações.  
4. Verifique se está como **base: dev** e **compare: feature/...**.  
5. Clique em **Create Pull Request**.  

---

> **Observação:**  
> Este projeto é parte do curso **Técnico em Desenvolvimento de Sistemas**. Usamos **Laragon** para servidor local e MySQL, e o código está em **PHP (PDO & OOP)**.  
