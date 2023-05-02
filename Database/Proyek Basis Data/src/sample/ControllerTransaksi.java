package sample;

import DBConnection.*;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;

import java.io.IOException;
import java.text.ParseException;
import java.time.LocalDate;

public class ControllerTransaksi {
    @FXML
    private TableView<Transaksi> tableViewTransaksi; // <Object>
    @FXML
    private TableColumn<Transaksi, Integer> colKode; // <Object, DataType>
    @FXML
    private TableColumn<Transaksi, String> colNama;
    @FXML
    private TableColumn<Transaksi, String> colTanggal;
    @FXML
    private TableColumn<Transaksi, String> colMetode;
    @FXML
    private TableColumn<Transaksi, Integer> colJumlah;
    @FXML
    private TableColumn<Transaksi, Integer> colIdCust;
    @FXML
    private TableColumn<Transaksi, Integer> colIdPB;
    @FXML
    private TableColumn<Transaksi, Integer> colIdRM;
    @FXML
    private TextField txtNama;
    @FXML
    private DatePicker txtTanggal;
    @FXML
    private TextField txtMetode;
    @FXML
    private TextField txtJumlah;
    @FXML
    private TextField txtIdCust;
    @FXML
    private TextField txtIdRM;
    @FXML
    private TextField txtIdPB;
    @FXML
    private RadioButton rbRM;
    @FXML
    private RadioButton rbPB;


    private static final Dao<Transaksi, Integer> tran = new TransaksiDao();

    private ObservableList<Transaksi> transaksis = FXCollections.observableArrayList();

    private Integer index;

    public static int pilih = 1;

    // Add new data using CustomerDao add(Customer customer)
    @FXML
    void addCustomer(ActionEvent event) {
        if (pilih == 1) {
            Transaksi transaksi = new Transaksi(0, txtNama.getText(), txtTanggal.getValue().toString(), txtMetode.getText(), Integer.parseInt(txtJumlah.getText()), Integer.parseInt(txtIdCust.getText()), null, Integer.parseInt(txtIdPB.getText()));
            tran.add(transaksi).ifPresent(transaksi::setKode_transaksi);
            viewAllRecord();
        } else if (pilih == 2) {
            Transaksi transaksi = new Transaksi(0, txtNama.getText(), txtTanggal.getValue().toString(), txtMetode.getText(), Integer.parseInt(txtJumlah.getText()), Integer.parseInt(txtIdCust.getText()), Integer.parseInt(txtIdRM.getText()), null);
            tran.add(transaksi).ifPresent(transaksi::setKode_transaksi);
            viewAllRecord();
        }
    }

    @FXML
    void getSelected(MouseEvent event) throws ParseException {
        // Get Index of the Selected Row
        index = tableViewTransaksi.getSelectionModel().getSelectedIndex();
        // Out of bound checking
        if (index <= -1) {
            return;
        }

        // Fill textField with Customer Data
        txtNama.setText(colNama.getCellData(index));
        txtTanggal.setValue(LocalDate.parse(colTanggal.getCellData(index)));
        txtMetode.setText(colMetode.getCellData(index));
        txtJumlah.setText(colJumlah.getCellData(index).toString());
        txtIdCust.setText(colIdCust.getCellData(index).toString());
        txtIdRM.setText(colIdRM.getCellData(index).toString());
        txtIdPB.setText(colIdPB.getCellData(index).toString());
    }

    // Update selected row data using CustomerDao update(Customer customer)
    @FXML
    void updateCustomer(ActionEvent event) {
        // Update by id, value from TextView
        if (pilih == 1) {
            Transaksi transaksi = new Transaksi(0, txtNama.getText(), txtTanggal.getValue().toString(), txtMetode.getText(), Integer.parseInt(txtJumlah.getText()), Integer.parseInt(txtIdCust.getText()), null, Integer.parseInt(txtIdPB.getText()));
            tran.update(transaksi);
            viewAllRecord();
        } else if (pilih == 2) {
            Transaksi transaksi = new Transaksi(0, txtNama.getText(), txtTanggal.getValue().toString(), txtMetode.getText(), Integer.parseInt(txtJumlah.getText()), Integer.parseInt(txtIdCust.getText()), Integer.parseInt(txtIdRM.getText()), null);
            tran.update(transaksi);
            viewAllRecord();
        }
    }

    // Delete selected row data using CustomerDao delete(int id)
    @FXML
    void deleteCustomer(ActionEvent event) {
        // Delete by id
        tran.delete(colKode.getCellData(index));
        viewAllRecord();
    }

    // Get table data using CustomerDao getAll()
    void viewAllRecord() {
        // Set all data from getAll into ObservableList<Customer>
        transaksis.setAll(tran.getAll());
        tableViewTransaksi.setItems(transaksis);
    }

    public void initialize() {
        // Initialize Table Column
        colKode.setCellValueFactory(new PropertyValueFactory<Transaksi, Integer>("kode_transaksi"));
        colNama.setCellValueFactory(new PropertyValueFactory<Transaksi, String>("nama_transaksi"));
        colTanggal.setCellValueFactory(new PropertyValueFactory<Transaksi, String>("tanggal_transaksi"));
        colMetode.setCellValueFactory(new PropertyValueFactory<Transaksi, String>("metode_pembayaran"));
        colJumlah.setCellValueFactory(new PropertyValueFactory<Transaksi, Integer>("jumlah_transaksi"));
        colIdCust.setCellValueFactory(new PropertyValueFactory<Transaksi, Integer>("id_customer"));
        colIdRM.setCellValueFactory(new PropertyValueFactory<Transaksi, Integer>("id_rumah_makan"));
        colIdPB.setCellValueFactory(new PropertyValueFactory<Transaksi, Integer>("id_penyedia_barang"));

        viewAllRecord();
    }

    @FXML
    public void select(ActionEvent event) {
        if (rbPB.isSelected()) {
            txtIdPB.setDisable(false);
            txtIdRM.setDisable(true);
            pilih = 1;
        } else if (rbRM.isSelected()) {
            txtIdRM.setDisable(false);
            txtIdPB.setDisable(true);
            pilih = 2;
        }
    }

    @FXML
    private Button goToDriver;
    //Ganti scene
    @FXML
    public void backToDriver(ActionEvent event) throws IOException {
        Parent driver = FXMLLoader.load(getClass().getResource("driver.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Driver");
        window.setScene(new Scene(driver));
        window.show();
    }
}
