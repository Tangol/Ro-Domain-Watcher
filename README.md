# Ro-Domain-Watcher
A short script created when I was hunting to see when a certain .ro domain name changed it state and became available for registration. Just update a few variables, set it in a cron for ~5-15 minutes and you'll receive email alerts when the domain is available


This scrapes the WHOIS output for information regarding the state, so you can adjust the script using the $posp , $posd variables to get emails for different states of the domain.
