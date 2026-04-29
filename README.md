<h1 align="center">☁️ Sistema de Registro Escolar - Servicios en la Nube</h1>

<p align="center">
  <img src="./public/estilos/img/logo.jpg" width="200">
</p>

---

## 📌 Descripción

Este proyecto fue desarrollado en la materia de **Servicios en la Nube**, con el objetivo de implementar una aplicación web dinámica utilizando **PHP y bases de datos MySQL**.

La plataforma funciona como un **sistema de gestión escolar**, donde se administran entidades como estudiantes, profesores, materias y asignaciones, permitiendo visualizar y registrar información en una base de datos.

---

## 🎯 Objetivo

Desarrollar una aplicación web que permita **gestionar información académica** mediante módulos organizados, utilizando conexión a base de datos y operaciones CRUD básicas.

---

## 🚀 Tecnologías utilizadas

- PHP (sin frameworks)
- MySQL
- phpMyAdmin
- HTML5
- CSS3
- JavaScript (básico)

---

## 🧩 Funcionalidades principales

### 📚 Módulos del sistema

- **Estudiantes**
  - Registro de estudiantes
  - Visualización en tabla con sus datos

- **Profesores**
  - Registro de profesores
  - Listado con información relevante

- **Materias**
  - Gestión de materias académicas
  - Visualización estructurada

- **Asignación**
  - Relación entre:
    - Estudiantes ↔ Materias
    - Profesores ↔ Materias
  - Visualización de:
    - Qué estudiante cursa qué materia
    - Qué profesor dicta cada materia

---

## 🗄️ Base de datos

- Nombre: **registro_escolar**
- Motor: MySQL
- Gestión: phpMyAdmin

### Relaciones implementadas

- Un **profesor** puede dictar varias materias
- Un **estudiante** puede estar inscrito en varias materias
- Cada asignación conecta:
  - estudiante + materia
  - profesor + materia

---

## 🗂️ Estructura del proyecto

- Paginas <p>
  las diferentes paginas
- app<p>
  controladores
- conf<p>
  base de datos
- layout<p>
  para no repetir algunos diseños
- public/estilos<p>
  estilos y procesos de las paginas<p>
index.php

---

## 👩‍💻 Autor

**Lesly González**  
Estudiante de Ingeniería Informática  
Rol: Desarrollar Frontend
