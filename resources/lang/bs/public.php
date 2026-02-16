<?php

return [
    'menu' => [
        'home' => 'Početna',
        'features' => 'Funkcionalnosti',
        'price' => 'Cijena',
        'contact' => 'Kontakt',
        'properties' => 'Nekretnine',
    ],
    'home' => [
        'title' => 'Vaša ultimativna platforma za premošćavanje jaza između vlasnika i stanara',
        'description' => ':name je dizajniran da pojednostavi odnos između vlasnika i stanara. Naša platforma vam pomaže da upravljate smještajem, pratite troškove, vodite računa o obračunima, rješavate probleme i upravljate zakupima efikasno, sve bez potrebe za odvojenе chat aplikacije.',
    ],
    'features' => [
        'title' => 'Glavne funkcionalnosti :name',
        'description' => ':name nudi sveobuhvatan skup alata za pojednostavljenje upravljanja nekretninama i poboljšanje komunikacije između vlasnika i stanara.',
        'charges' => [
            'title' => 'Praćenje troškova i obračuna',
            'description' => 'Pratite troškove i obračune za vlasnike i stanare.',
        ],
        'issues' => [
            'title' => 'Rješavanje problema',
            'description' => 'Prijavite i riješite probleme efikasno unutar platforme.',
        ],
        'lease' => [
            'title' => 'Upravljanje zakupima',
            'description' => 'Upravljajte i pratite zakupe s lakoćom.',
        ],
        'property' => [
            'title' => 'Upravljanje nekretninama',
            'description' => 'Upravljajte i pratite stanje nekretnine.',
        ],
    ],
    'pricing' => [
        'title' => 'Cijenovnik',
        'heading' => 'Naši Paketi Usluga',
        'description' => 'Odaberite paket koji najbolje odgovara Vašim potrebama i budžetu.',
        'per_month' => 'mjesečno',
        'free' => [
            'name' => 'Besplatno',
            'description' => 'Savršeno za početak s jednom nekretninom.',
            'cta' => 'Započni besplatno',
            'features' => [
                'properties' => '1 Nekretnina',
                'leases' => 'Neograničeni zakupi',
                'expenses' => 'Praćenje troškova',
                'issues' => 'Upravljanje problemima',
            ],
        ],
        'standard' => [
            'name' => 'Standard',
            'description' => 'Za vlasnike s više nekretnina.',
            'cta' => 'Započni',
            'features' => [
                'properties' => 'Do 3 nekretnine',
                'extra' => '+€5/mj po dodatnoj nekretnini',
                'leases' => 'Neograničeni zakupi',
                'all_features' => 'Sve funkcionalnosti uključene',
            ],
        ],
        'pro' => [
            'name' => 'Pro',
            'description' => 'Za upravljače nekretnina i agencije.',
            'cta' => 'Započni',
            'features' => [
                'properties' => 'Neograničen broj nekretnina',
                'leases' => 'Neograničeni zakupi',
                'all_features' => 'Sve funkcionalnosti uključene',
                'priority' => 'Prioritetna podrška',
            ],
        ],
    ],
    'contact' => [
        'title' => 'Kontaktirajte Nas',
        'heading' => 'Stupite u Kontakt',
        'form' => [
            'title' => 'Pošaljite Nam Poruku',
            'full_name' => 'Puno Ime',
            'email' => 'Email Adresa',
            'phone' => 'Broj Telefona',
            'message' => 'Vaša Poruka',
            'submit' => 'Pošaljite',
            'placeholder' => [
                'full_name' => 'Unesite svoje puno ime',
                'email' => 'Unesite svoju email adresu',
                'phone' => 'Unesite svoj broj telefona',
                'message' => 'Unesite svoju poruku ovdje...',
            ],
        ],

    ],
    'properties' => [
        'title' => 'Pregled nekretnina',
        'description' => 'Istražite dostupne nekretnine za iznajmljivanje koje su vlasnici objavili na našoj platformi.',
        'search_placeholder' => 'Pretražite po nazivu ili lokaciji...',
        'no_results' => 'Nije pronađena nijedna nekretnina.',
        'details' => 'Detalji nekretnine',
        'amenities' => 'Pogodnosti',
        'floor' => 'Sprat',
        'size' => 'Površina',
        'rooms' => 'Sobe',
        'bathrooms' => 'Kupatila',
        'heating' => 'Grijanje',
        'year_built' => 'Godina izgradnje',
        'furnished' => 'Namješteno',
        'parking' => 'Parking',
        'elevator' => 'Lift',
        'balcony' => 'Balkon',
        'yes' => 'Da',
        'no' => 'Ne',
        'back' => 'Nazad na nekretnine',
        'gallery' => 'Galerija',
        'heating_types' => [
            'central' => 'Centralno grijanje',
            'gas' => 'Plin',
            'electric' => 'Električno',
            'wood' => 'Drva',
            'heat_pump' => 'Toplotna pumpa',
        ],
    ],
    'terms' => [
        'title' => 'Uslovi korištenja',
        'last_updated' => 'Posljednja izmjena: :date',
        'sections' => [
            'acceptance' => [
                'title' => 'Prihvatanje uslova',
                'body' => 'Pristupanjem ili korištenjem platforme :name, prihvatate ove Uslove korištenja. Ukoliko se ne slažete s ovim uslovima, molimo vas da ne koristite naš servis.',
            ],
            'description' => [
                'title' => 'Opis usluge',
                'body' => ':name je platforma za upravljanje nekretninama koja omogućava vlasnicima i stanarima da upravljaju nekretninama, zakupima, troškovima, plaćanjima i problemima na jednom mjestu.',
            ],
            'accounts' => [
                'title' => 'Korisnički nalozi',
                'body' => 'Odgovorni ste za čuvanje povjerljivosti vaših pristupnih podataka i za sve aktivnosti koje se odvijaju pod vašim nalogom. Morate navesti tačne i potpune podatke prilikom kreiranja naloga i redovno ih ažurirati.',
            ],
            'plans' => [
                'title' => 'Pretplatni paketi i cijene',
                'body' => ':name nudi sljedeće pretplatne pakete:',
                'free' => 'Besplatno — 1 nekretnina, sve funkcionalnosti uključene.',
                'standard' => 'Standard (€12/mjesečno) — do 3 nekretnine, s dodatnim nekretninama za €5/mjesečno po nekretnini.',
                'pro' => 'Pro (€39/mjesečno) — neograničen broj nekretnina, prioritetna podrška.',
                'changes' => 'Cijene se mogu promijeniti uz obavještenje 30 dana unaprijed. Promjene neće utjecati na vaš tekući period naplate.',
            ],
            'payments' => [
                'title' => 'Plaćanja i naplata',
                'body' => 'Plaćene pretplate se naplaćuju mjesečno. Ovlašćujete nas da naplatimo izabrani način plaćanja na periodičnoj osnovi. Pretplatu možete otkazati u bilo kom trenutku i ona ostaje aktivna do kraja tekućeg perioda naplate.',
            ],
            'use' => [
                'title' => 'Prihvatljivo korištenje',
                'body' => 'Saglasni ste da nećete koristiti servis u nezakonite svrhe, otpremati zlonamjeran sadržaj, pokušavati neovlašten pristup drugim nalozima ili sistemima, niti ometati rad platforme.',
            ],
            'data' => [
                'title' => 'Vaši podaci',
                'body' => 'Zadržavate vlasništvo nad svim podacima koje otpremate na :name. Mi ne polažemo prava intelektualne svojine na vaš sadržaj. Pogledajte našu Politiku privatnosti za detalje o rukovanju vašim podacima.',
            ],
            'termination' => [
                'title' => 'Prekid usluge',
                'body' => 'Zadržavamo pravo da suspendujemo ili ukinemo vaš nalog ukoliko prekršite ove uslove. Svoj nalog možete obrisati u bilo kom trenutku. Po prekidu, vaši podaci će biti zadržani 30 dana prije trajnog brisanja.',
            ],
            'liability' => [
                'title' => 'Ograničenje odgovornosti',
                'body' => ':name se pruža „kako jeste" bez garancija bilo koje vrste. Nismo odgovorni za bilo kakvu indirektnu, slučajnu ili posljedičnu štetu nastalu korištenjem servisa. Naša ukupna odgovornost ne prelazi iznos koji ste platili u 12 mjeseci prije nastanka zahtjeva.',
            ],
            'changes' => [
                'title' => 'Promjene uslova',
                'body' => 'Ove uslove možemo povremeno ažurirati. O značajnim promjenama ćemo vas obavijestiti putem emaila ili putem obavještenja na platformi. Nastavak korištenja servisa nakon promjena znači prihvatanje ažuriranih uslova.',
            ],
            'contact' => [
                'title' => 'Kontakt',
                'body' => 'Ukoliko imate pitanja o ovim Uslovima korištenja, kontaktirajte nas na :email.',
            ],
        ],
    ],
    'privacy' => [
        'title' => 'Politika privatnosti',
        'last_updated' => 'Posljednja izmjena: :date',
        'sections' => [
            'intro' => [
                'title' => 'Uvod',
                'body' => ':name je posvećen zaštiti vaše privatnosti. Ova Politika privatnosti objašnjava koje podatke prikupljamo, kako ih koristimo i vaša prava u vezi s ličnim podacima.',
            ],
            'collected' => [
                'title' => 'Podaci koje prikupljamo',
                'body' => 'Prikupljamo sljedeće vrste podataka:',
                'items' => [
                    'account' => 'Podaci o nalogu: ime, email adresa i lozinka prilikom registracije.',
                    'property' => 'Podaci o nekretnini: detalji nekretnine, informacije o zakupu i dokumenti koje otpremate.',
                    'payment' => 'Podaci o plaćanju: podaci za naplatu se obrađuju sigurno putem našeg provajdera plaćanja. Ne čuvamo potpune podatke vaše platne kartice.',
                    'communication' => 'Podaci o komunikaciji: poruke i prijave problema podnesene putem platforme.',
                ],
            ],
            'analytics' => [
                'title' => 'Analitika i praćenje',
                'body' => ':name koristi Umami za analitiku web stranice. Umami je alat za analitiku fokusiran na privatnost koji:',
                'items' => [
                    'no_cookies' => 'Ne koristi kolačiće niti bilo koji oblik trajnog praćenja.',
                    'no_personal' => 'Ne prikuplja nikakve lične podatke.',
                    'no_tracking' => 'Ne prati korisnike između web stranica ili sesija.',
                    'gdpr' => 'U potpunosti je usklađen s GDPR propisima i podrazumijevano poštuje vašu privatnost.',
                ],
            ],
            'usage' => [
                'title' => 'Kako koristimo vaše podatke',
                'body' => 'Vaše podatke koristimo u sljedeće svrhe:',
                'items' => [
                    'service' => 'Za pružanje i održavanje servisa, uključujući upravljanje nekretninama, praćenje zakupa i potvrdu plaćanja.',
                    'communication' => 'Za komunikaciju s vama o vašem nalogu, ažuriranjima i zahtjevima za podršku.',
                    'security' => 'Za osiguranje sigurnosti i integriteta platforme.',
                    'legal' => 'Za usklađenost sa zakonskim obavezama.',
                ],
            ],
            'sharing' => [
                'title' => 'Dijeljenje podataka',
                'body' => ':name ne prodaje, ne trguje niti iznajmljuje vaše lične podatke trećim stranama. Podatke možemo dijeliti samo s: pružaocima usluga neophodnim za rad platforme (npr. hosting, obrada plaćanja) ili kada to zakon nalaže.',
            ],
            'retention' => [
                'title' => 'Čuvanje podataka',
                'body' => 'Vaše lične podatke čuvamo dok je vaš nalog aktivan. Ako obrišete nalog, vaši podaci će biti trajno uklonjeni u roku od 30 dana, osim gdje zakon nalaže duže čuvanje.',
            ],
            'rights' => [
                'title' => 'Vaša prava',
                'body' => 'U skladu s važećim zakonima o zaštiti podataka (uključujući GDPR), imate pravo da:',
                'items' => [
                    'access' => 'Pristupite ličnim podacima koje čuvamo o vama.',
                    'rectification' => 'Zahtijevate ispravku netačnih podataka.',
                    'deletion' => 'Zahtijevate brisanje vaših podataka („pravo na zaborav").',
                    'export' => 'Zahtijevate kopiju vaših podataka u prenosivom formatu.',
                ],
            ],
            'security' => [
                'title' => 'Sigurnost podataka',
                'body' => 'Primjenjujemo odgovarajuće tehničke i organizacione mjere za zaštitu vaših ličnih podataka od neovlaštenog pristupa, izmjene, otkrivanja ili uništenja. Svi podaci se prenose putem šifriranih konekcija (HTTPS).',
            ],
            'changes' => [
                'title' => 'Promjene ove politike',
                'body' => 'Ovu Politiku privatnosti možemo povremeno ažurirati. O svim značajnim promjenama ćemo vas obavijestiti putem emaila ili putem obavještenja na platformi.',
            ],
            'contact' => [
                'title' => 'Kontaktirajte nas',
                'body' => 'Ukoliko imate pitanja o ovoj Politici privatnosti ili želite ostvariti svoja prava, kontaktirajte nas na :email.',
            ],
        ],
    ],
    'SignIn' => "Uloguj se",
    'SignUp' => "Registruj se",
    "description" => "Tenex pojednostavljuje upravljanje nekretninama i komunikaciju između vlasnika i stanara. Upravljajte smještajem, pratite troškove, vodite računa o obračunima, rješavajte probleme i upravljajte zakupima—sve na jednom mjestu.",
    "keywords" => "upravljanje nekretninama, softver za vlasnike, platforma za stanare, zakup, praćenje troškova, obračuni, komunikacija vlasnik-stanar",
];
