from faker import Faker
import random
from datetime import datetime, timedelta

fake = Faker("id")  # Mengatur bahasa Indonesia

def format_nama(nama):
    nama_formatted = ' '.join(word.capitalize() for word in nama.split())
    return nama_formatted.replace(" ", "")

def generate_username(nama):
    return nama.replace(" ", "").lower()

def generate_password():
    return ''.join(random.choice('abcdefghijklmnopqrstuvwxyz0123456789') for _ in range(8))

def random_date(start_date, end_date):
    time_between_dates = end_date - start_date
    days_between_dates = time_between_dates.days
    random_number_of_days = random.randrange(days_between_dates)
    return start_date + timedelta(days=random_number_of_days)

start_date = datetime.strptime('2020-01-01', '%Y-%m-%d')
end_date = datetime.strptime('2023-12-31', '%Y-%m-%d')

sql_statements = []

for i in range(6, 506):
    full_name = fake.name_male()
    username = generate_username(full_name)
    password = "202cb962ac59075b964b07152d234b70"
    jenis_kelamin = "Laki-Laki"
    jabatan = "Karyawan"
    tanggal_masuk = random_date(start_date, end_date).strftime('%Y-%m-%d')
    status = "Karyawan Tetap"
    photo = "av5.png"
    hak_akses = 2
    
    sql_statement = f"({i}, '1722000{i}', '{full_name}', '{username}', '{password}', '{jenis_kelamin}', '{jabatan}', '{tanggal_masuk}', '{status}', '{photo}', {hak_akses})"
    sql_statements.append(sql_statement)

chunk_size = 100
sql_chunks = [sql_statements[i:i + chunk_size] for i in range(0, len(sql_statements), chunk_size)]

for index, chunk in enumerate(sql_chunks):
    sql_values = ',\n'.join(chunk)
    sql_query = f"INSERT INTO `data_pegawai` (`id_pegawai`, `nik`, `nama_pegawai`, `username`, `password`, `jenis_kelamin`, `jabatan`, `tanggal_masuk`, `status`, `photo`, `hak_akses`) VALUES\n{sql_values};"
    print(f"Bagian {index + 1}:\n{sql_query}\n")

# Simpan ke dalam file
file_name = 'data_pegawai.sql'  # Nama file untuk menyimpan hasil SQL
with open(file_name, 'w') as file:
    for index, chunk in enumerate(sql_chunks):
        sql_values = ',\n'.join(chunk)
        sql_query = f"INSERT INTO `data_pegawai` (`id_pegawai`, `nik`, `nama_pegawai`, `username`, `password`, `jenis_kelamin`, `jabatan`, `tanggal_masuk`, `status`, `photo`, `hak_akses`) VALUES\n{sql_values};\n"
        file.write(f"Bagian {index + 1}:\n{sql_query}\n")

print(f"Data telah disimpan ke dalam file: {file_name}")