import pandas as pd
import pywhatkit as kit
import time

def enviar_mensagens(arquivo_excel, intervalo=10):
    try:
        # Carregar a planilha Excel
        dados = pd.read_excel(arquivo_excel, sheet_name='Dados')
        
        for index, linha in dados.iterrows():
            nome = linha['Nome']
            numero = str(linha['Número'])
            mensagem = linha['Mensagem'].replace('{Nome}', nome)
            
            print(f"Enviando mensagem para {nome} no número {numero}...")
            
            # Enviar mensagem pelo WhatsApp
            kit.sendwhatmsg_instantly(numero, mensagem, wait_time=15)
            
            print(f"Mensagem enviada para {nome}.")
            
            # Aguardar antes de enviar a próxima mensagem
            time.sleep(intervalo)
    except Exception as e:
        print(f"Ocorreu um erro: {e}")

if __name__ == "__main__":
    # Arquivo Excel com os dados
    arquivo = 'clientes.xlsx'
    
    # Intervalo entre mensagens (em segundos)
    intervalo_envio = 20
    
    enviar_mensagens(arquivo, intervalo_envio)
