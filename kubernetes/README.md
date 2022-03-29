gcloud container clusters create all-test


kubectl apply -f email.yaml


all-test

kubectl get nodes
kubectl get pods
kubectl describe pod {podName}
gcloud clusters delete {clusterName}







---

## 1. Базовая работа по включения gcloud + kubernetes


```
https://www.youtube.com/watch?v=ZHv1c64PXO4&list=PLg5SS_4L6LYvN1RqaVesof8KAf-02fJSi&index=5
# 1 подготовка

1. скачать google cloud sdk
2. скачать kubectl
3. (единожды сделать) gcloud init

# 2 Заходим в облако

https://console.cloud.google.com/ => menu
(сервера)kubernetes engine => clusters
compute engine => vm instances

# 3 создаём Google cloud кластер
gcloud container clusters create {clusterName} => gcloud container clusters create alex1

# 4 коннектим cubectl с gcloud
gcloud container clusters get-credentials {clusterName}

# 5 проверяем что получилось
kubectl cluster-info
kubectl get componentstatuses
kubectl get nodes
kubectl get pods

```

## 2 Создание и управление pods

```
при включенном kubectl в gcloud

тоесть, когда не будут пустыми
kubectl cluster-info
kubectl get nodes





```