#!/bin/bash

curl -d "serial=xpto-123&temperatura=20&humidade=2.3" localhost:8000/api/leitura -vvv