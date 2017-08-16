#!/bin/bash

start() {
	php /var/www/html/ramal_virtual/daemons/notification_email_daemon/daemon.php & echo $!>/var/run/notification_email_daemon.pid
}

stop() {
	kill `cat /var/run/notification_email_daemon.pid`
	rm /var/run/notification_email_daemon.pid
}

isRunning(){
    if [ -f /var/run/notification_email_daemon.pid ]; then
       echo true
    else
       echo false
    fi
}

case "$1" in 
    start)
       start
       ;;
    stop)
       if [ "$( isRunning )" == "true" ]; then
           stop
       else 
           echo o daemon já está parado
       fi
       ;;
    restart)
       if [ "$( isRunning )" == "true" ]; then
	  stop
       fi
       start
       ;;
    status)
       #is_running = $( isRunning )
       if [ "$(isRunning)" == "true" ]; then
           echo o daemon está rodando, pid=`cat /var/run/notification_email_daemon.pid`
       else
           echo o daemon está parado
       exit 1
       fi
       ;;
*)
   echo "Usage: $0 {start|stop|status|restart}"
esac

exit 0 
