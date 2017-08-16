#!/bin/bash

SERVICE_NAME="rv_notificacoes"
SERVICE_FULL_PATH="/etc/init.d/$SERVICE_NAME"

# CORES 
GREEN='\033[0;32m'
RED='\033[0;33m'
NC='\033[0m' # No Color
# /CORES

exists(){
	if [ -f $SERVICE_FULL_PATH  ]; then
		echo true
	else
		echo false
	fi
}

removeServiceFile(){
	rm -f  $SERVICE_FULL_PATH
	#retorna true se realmente excluiu
	echo $(exists) == false
}

copyServiceFile(){
	cp ${SERVICE_NAME}.sh  $SERVICE_FULL_PATH
	
	if [ "$(exists)" ]; then
		echo -e "--> ${GREEN} Arquivo copiado com sucesso !! ${NC}" >&2
	else 
		echo -e "--> ${RED}Falha ao copiar arquivo ${NC}" >&2
	fi
	
	echo $(exists)
}

if [ $(exists) == "true" ]; then
	echo "--> O arquivo já existe" 
	echo "--> Tentando remover o arquivo..."

	if [ "$(removeServiceFile)" ]; then
		echo "--> Arquivo removido com sucesso..."
		echo "--> Copiando arquivo novo..."
		$(copyServiceFile)
		
	else 
		echo "--> Falha ao remover arquivo..."
		exit
	fi

else 
	echo "--> O arquivo não existe..."
	$(copyServiceFile)
fi