<div class="nav" style="background: -webkit-linear-gradient(
    
    #292acf,
    #00a6f4,
    #84f0c7
    
    
  ); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    
    #292acf,
    #00a6f4,
    #84f0c7
  );">
    <nav>
        <ul>
            <?php
            if ($_SESSION["user"]["role"] == 'Администратор') {
                echo '
                <li><a href="/main.php">Аналитическая страница</a></li>
            <li><a href="/fact.php">Добавить новый факт обнаружения</a></li>
            <li><a href="/reestr_facts.php">Реестр фактов обнаружения</a></li>
            <li><a href="/reestr_banknote.php">Реестр фальшивых денег</a></li>
            <li><a href="/reestr_uch.php">Реестр участников</a></li>
            <li><a href="/big_map.php">Карта фактов обнаружения подделок</a></li>
            <li><a href="/admin/users.php">Добавить пользователя</a></li>
            <li><a href="/admin/user_mon.php">Управление пользователями</a></li>
            <li><a href="/journal.php">Журнал действий</a></li>
                    ';
            } else if ($_SESSION["user"]["role"] == 'Оперативный сотрудник') {
                echo '
                <li><a href="/main.php">Аналитическая страница</a></li>
            <li><a href="/reestr_facts.php">Реестр фактов обнаружения</a></li>
            <li><a href="/reestr_banknote.php">Реестр фальшивых денег</a></li>
            <li><a href="/reestr_uch.php">Реестр участников</a></li>
            <li><a href="/big_map.php">Карта фактов обнаружения подделок</a></li>
            <li><a href="/journal.php">Журнал действий</a></li>
                    ';
            } else {
                echo '
                <li><a href="/main.php">Аналитическая страница</a></li>
            <li><a href="/fact.php">Добавить новый факт обнаружения</a></li>
            <li><a href="/reestr_facts.php">Реестр фактов обнаружения</a></li>
            <li><a href="/reestr_banknote.php">Реестр фальшивых денег</a></li>
            <li><a href="/reestr_uch.php">Реестр участников</a></li>
            <li><a href="/big_map.php">Карта фактов обнаружения подделок</a></li>
            <li><a href="/journal.php">Журнал действий</a></li>
                    ';
            }
            ?>
        </ul>
    </nav>
</div>