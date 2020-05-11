#!/bin/bash
# Skript pre vykonavanie prikazov z databazy do screenu v linuxe 
while read -r output;
do
    prikaz=$(echo "$output" | awk -F"\t" '{print $2}')
	screen -S Bungeecord -X stuff "$prikaz  $(echo '\r')"
done< <(mysql -u meno -pheslo  databaza -h 0 -e "select * from antibot where vykonane = 0;" | sed 1d)
mysql -u meno -pheslo databaza -e "UPDATE antibot SET vykonane = '1' WHERE vykonane='0'";