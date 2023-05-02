package DBConnection;

public class Driver {
    int id_driver;
    String nama_driver;
    String plat_nomor_driver;

    public Driver(int id_driver, String nama_driver, String plat_nomor_driver) {
        this.id_driver = id_driver;
        this.nama_driver = nama_driver;
        this.plat_nomor_driver = plat_nomor_driver;
    }

    public int getId_driver() {
        return id_driver;
    }

    public void setId_driver(int id_driver) {
        this.id_driver = id_driver;
    }

    public String getNama_driver() {
        return nama_driver;
    }

    public void setNama_driver(String nama_driver) {
        this.nama_driver = nama_driver;
    }

    public String getPlat_nomor_driver() {
        return plat_nomor_driver;
    }

    public void setPlat_nomor_driver(String plat_nomor_driver) {
        this.plat_nomor_driver = plat_nomor_driver;
    }
}
