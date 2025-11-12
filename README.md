# 🏆 Torneo Clash Royale

Una aplicación web para gestionar torneos privados de Clash Royale entre 8 jugadores con sistema round robin.

## ✨ Características

- 🎮 **Sistema Round Robin**: Todos contra todos en una sola vuelta
- 👑 **8 Jugadores**: Gestión automática de enfrentamientos
- ⚔️ **Interfaz Gaming**: Diseño inspirado en Clash Royale
- 📊 **Tabla de Clasificación**: Puntos y estadísticas en tiempo real
- 🔐 **Modo Admin Seguro**: Código secreto para registrar resultados
- 📈 **Progreso del Torneo**: Barra de progreso visual
- 🎨 **Responsive**: Funciona en desktop y móvil

## 🚀 Instalación

### Requisitos
- PHP 8.1+
- Laravel 10+
- MySQL 5.7+
- Composer

### Pasos de instalación

1. **Clonar el repositorio**
```bash
git clone <tu-repositorio>
cd torneo-clash
```

2. **Instalar dependencias**
```bash
composer install
npm install
```

3. **Configurar entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=torneo_clash
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

5. **Ejecutar migraciones**
```bash
php artisan migrate --seed
```

6. **Configurar código admin (opcional)**
```env
ADMIN_CODE=tu_clave_secreta
```

7. **Ejecutar en desarrollo**
```bash
php artisan serve
npm run dev
```

## 🎯 Uso de la Aplicación

### Para Administradores
1. **Activar modo admin**: Click en "Activar Modo Admin" e ingresar código secreto
2. **Generar enfrentamientos**: Botón "Generar Enfrentamientos del Torneo"
3. **Registrar resultados**: Click en el ganador de cada partido
4. **Corregir errores**: Botón "Reiniciar Partido" si es necesario

### Para Espectadores
- Ver enfrentamientos por rondas
- Consultar tabla de clasificación
- Seguir progreso del torneo

## 👥 Jugadores por Defecto
El sistema incluye 8 jugadores predefinidos:
- Jeremy
- Jairo  
- Carlos
- Aroca
- Cristian
- Zamith
- Keyn
- Jugador_8

## 🏗️ Estructura del Proyecto

```
app/
├── Models/
│   ├── Jugador.php
│   └── Partido.php
├── Http/
│   ├── Controllers/
│   │   ├── TorneoController.php
│   │   └── PartidoController.php
│   └── Middleware/
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── enfrentamientos.blade.php
│   ├── clasificacion.blade.php
│   └── inicio.blade.php
database/
├── migrations/
│   ├── create_jugadores_table.php
│   └── create_partidos_table.php
└── seeders/
    └── JugadoresSeeder.php
```

## 🔧 Configuración Avanzada

### Personalizar Jugadores
Editar `database/seeders/JugadoresSeeder.php`

### Cambiar Código Admin
Editar `resources/views/enfrentamientos.blade.php` línea ~15:
```javascript
if (this.codigo === 'tu_nuevo_codigo') {
```

### Modificar Sistema de Puntos
Editar `app/Http/Controllers/PartidoController.php` método `actualizarEstadisticasJugadores`

## 📊 Especificaciones Técnicas

- **Framework**: Laravel 10
- **Frontend**: Blade, Tailwind CSS, Alpine.js
- **Base de datos**: MySQL
- **Formato**: Round Robin (7 rondas, 28 partidos)
- **Puntuación**: 1 punto por victoria

## 🐛 Solución de Problemas

### Error "No such file or directory"
```bash
php artisan cache:clear
php artisan config:clear
```

### Error de base de datos
```bash
php artisan migrate:fresh --seed
```

### Los botones admin no funcionan
- Verificar que el código admin sea correcto
- Revisar la consola del navegador para errores JavaScript

**¡Que gane el mejor!** 👑
