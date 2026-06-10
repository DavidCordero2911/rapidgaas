import pymysql
import pandas as pd
import matplotlib.pyplot as plt

# --- Conexión a la base de datos ---
conn = pymysql.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="rapidgaas"
)

# --- Extracción ---
df = pd.read_sql("SELECT * FROM ordenes_trabajo", conn)

# --- Transformación ---
df['fecha_entrada'] = pd.to_datetime(df['fecha_entrada'])
df['fecha_entrega'] = pd.to_datetime(df['fecha_entrega'])
df['dias_reparacion'] = (df['fecha_entrega'] - df['fecha_entrada']).dt.days

# --- Gráfica 1: Órdenes por estado ---
conteo_estados = df['estado'].value_counts()
conteo_estados.plot(kind='bar', color='#185FA5')
plt.title("Número de órdenes por estado")
plt.xlabel("Estado")
plt.ylabel("Cantidad de órdenes")
plt.tight_layout()
plt.savefig("ordenes_por_estado.png")
plt.close()

# --- Gráfica 2: Tiempo medio de reparación por mecánico ---
medias = df.dropna(subset=['dias_reparacion']).groupby('mecanico_id')['dias_reparacion'].mean()
medias.plot(kind='bar', color='#E2700A')
plt.title("Tiempo medio de reparación por mecánico (días)")
plt.xlabel("ID Mecánico")
plt.ylabel("Días promedio")
plt.tight_layout()
plt.savefig("tiempo_medio_por_mecanico.png")
plt.close()

# --- Exportación a Excel ---
with pd.ExcelWriter("informe_ordenes.xlsx") as writer:
    df.to_excel(writer, sheet_name="Ordenes", index=False)
    conteo_estados.to_frame("total").to_excel(writer, sheet_name="Resumen_Estados")
    medias.to_frame("dias_promedio").to_excel(writer, sheet_name="Resumen_Mecanico")

print("Informe generado correctamente.")
