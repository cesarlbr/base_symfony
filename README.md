# base

installer le projet :

```bash
# cloner le repository
git clone https://github.com/mithridatem/base
# déplacer dans le repository
cd base
# installer les dépendances
composer install
# créer la base de données
symfony console d:d:c
# migrer la stucture de données
symfony console d:m:m
# appliquer les fixtures (données de test)
symfony console d:f:l
```
