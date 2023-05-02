package DBConnection;

public class PenyediaBarang {
    int id_penyedia_barang;
    String nama_penyedia_barang;
    String alamat_penyedia_barang;
    String no_telp_penyedia_barang;

    public PenyediaBarang(int id_penyedia_barang, String nama_penyedia_barang, String alamat_penyedia_barang, String no_telp_penyedia_barang) {
        this.id_penyedia_barang = id_penyedia_barang;
        this.nama_penyedia_barang = nama_penyedia_barang;
        this.alamat_penyedia_barang = alamat_penyedia_barang;
        this.no_telp_penyedia_barang = no_telp_penyedia_barang;
    }

    public int getId_penyedia_barang() {
        return id_penyedia_barang;
    }

    public void setId_penyedia_barang(int id_penyedia_barang) {
        this.id_penyedia_barang = id_penyedia_barang;
    }

    public String getNama_penyedia_barang() {
        return nama_penyedia_barang;
    }

    public void setNama_penyedia_barang(String nama_penyedia_barang) {
        this.nama_penyedia_barang = nama_penyedia_barang;
    }

    public String getAlamat_penyedia_barang() {
        return alamat_penyedia_barang;
    }

    public void setAlamat_penyedia_barang(String alamat_penyedia_barang) {
        this.alamat_penyedia_barang = alamat_penyedia_barang;
    }

    public String getNo_telp_penyedia_barang() {
        return no_telp_penyedia_barang;
    }

    public void setNo_telp_penyedia_barang(String no_telp_penyedia_barang) {
        this.no_telp_penyedia_barang = no_telp_penyedia_barang;
    }
}
