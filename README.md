# Aplikace pro správu knih

## O projektu

Tento projekt je výsledkem celodenního cvičení ve škole s časovým limitem 8 hodin. Jedná se o jednoduchou webovou aplikaci pro správu knih napsanou v PHP s využitím MySQL databáze.

**Autor:** Robin Lassak  
**Časový limit:** 8 hodin  
**Typ projektu:** Školní cvičení

## Popis aplikace

Aplikace umožňuje správu knih v databázi s následujícími funkcemi:

### Hlavní funkce:
1. **Zobrazení seznamu knih** - přehled všech knih v databázi
2. **Přidání nové knihy** - formulář pro vložení nové knihy
3. **Vyhledávání knih** - vyhledávání podle různých kritérií

### Datový model knihy:
- ISBN
- Jméno autora
- Příjmení autora
- Název knihy
- Popis knihy
- URL obrázku obalu

## Struktura projektu

### Hlavní soubory:
- `index.php` - hlavní stránka se seznamem knih
- `pridatKnihu.php` - formulář pro přidání nové knihy
- `vyhledatKnihu.php` - vyhledávací formulář a zobrazení výsledků

### Třídy a logika:
- `Kniha.php` - model knihy s vlastnostmi a konstruktorem
- `RepozitarKnih.php` - repository třída pro práci s databází
- `Databaze.php` - singleton třída pro připojení k databázi
- `map_knihy.php` - soubor pro načítání všech potřebných tříd

### Konfigurace:
- `prihlasovaci_udaje.php` - konfigurace databáze (není v git repozitáři)

## Technologie

- **Backend:** PHP 7+
- **Databáze:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap 5.3.3
- **Databázové rozhraní:** PDO

## Architektura

Aplikace používá jednoduchou MVC architekturu:
- **Model:** Třída `Kniha` reprezentuje datový model
- **View:** HTML šablony s Bootstrap stylingem
- **Controller:** PHP skripty zpracovávající požadavky

### Design Patterns:
- **Singleton Pattern** - pro připojení k databázi
- **Repository Pattern** - pro práci s daty knih

## Databáze

Aplikace používá MySQL databázi s tabulkou `EvidenceKnih` obsahující sloupce:
- id (primární klíč)
- isbn
- jmeno
- prijmeni
- nazev
- popis
- obrazek

## Bezpečnost

- Použití PDO prepared statements pro prevenci SQL injection
- HTML escaping pomocí `htmlspecialchars()` pro prevenci XSS útoků
- Konfigurační soubor s přihlašovacími údaji je vyloučen z git repozitáře

## Instalace a spuštění

1. Naklonujte repozitář
2. Vytvořte soubor `prihlasovaci_udaje.php` s konfigurací databáze:
```php
<?php 
    return[
        'host' => 'your_host',
        'db'=> 'your_database',
        'user'=> 'your_username',
        'pass'=> 'your_password'
    ];
?>
```
3. Vytvořte tabulku `EvidenceKnih` v databázi
4. Spusťte aplikaci na PHP serveru

## Funkcionality

### Seznam knih (`index.php`)
- Zobrazuje všechny knihy v tabulce
- Obsahuje navigační menu
- Responzivní design s Bootstrap

### Přidání knihy (`pridatKnihu.php`)
- Formulář pro zadání všech údajů o knize
- Validace povinných polí
- Automatické přesměrování po úspěšném přidání

### Vyhledávání (`vyhledatKnihu.php`)
- Vyhledávání podle ISBN, jména autora, příjmení autora nebo názvu knihy
- Částečné vyhledávání (LIKE operátor)
- Zobrazení výsledků v tabulce
- Ošetření chyb při prázdném vyhledávání

## Omezení projektu

Vzhledem k časovému limitu 8 hodin obsahuje aplikace základní funkcionality:
- Chybí editace a mazání knih
- Chybí pokročilé filtrování
- Chybí autentifikace uživatelů
- Chybí validace na straně serveru
- Chybí nahrávání obrázků (pouze URL odkazy)

## Závěr

Aplikace demonstruje základní znalosti PHP, MySQL a webového vývoje. I přes časové omezení obsahuje funkční CRUD operace pro správu knih s moderním responzivním designem.
