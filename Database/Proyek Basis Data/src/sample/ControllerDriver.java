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
import javafx.scene.control.Button;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;

import java.io.IOException;

public class ControllerDriver {
    @FXML
    private TableView<Driver> tableViewDriver; // <Object>
    @FXML
    private TableColumn<Driver, Integer> colId; // <Object, DataType>
    @FXML
    private TableColumn<Driver, String> colNama;
    @FXML
    private TableColumn<Driver, String> colPlatNo;
    @FXML
    private TextField txtNama;
    @FXML
    private TextField txtPlatNo;

    private static final Dao<Driver, Integer> driv = new DriverDao();

    private ObservableList<Driver> drivers = FXCollections.observableArrayList();

    private Integer index;

    // Add new data using CustomerDao add(Customer customer)
    @FXML
    void addCustomer(ActionEvent event) {
        Driver driver = new Driver(0, txtNama.getText(), txtPlatNo.getText());
        driv.add(driver).ifPresent(driver::setId_driver);
        viewAllRecord();
    }

    @FXML
    void getSelected(MouseEvent event) {
        // Get Index of the Selected Row
        index = tableViewDriver.getSelectionModel().getSelectedIndex();
        // Out of bound checking
        if (index <= -1) {
            return;
        }

        // Fill textField with Customer Data
        txtNama.setText(colNama.getCellData(index));
        txtPlatNo.setText(colPlatNo.getCellData(index));
    }

    // Update selected row data using CustomerDao update(Customer customer)
    @FXML
    void updateCustomer(ActionEvent event) {
        // Update by id, value from TextView
        Driver driver = new Driver(colId.getCellData(index), txtNama.getText(), txtPlatNo.getText());
        driv.update(driver);
        viewAllRecord();
    }

    // Delete selected row data using CustomerDao delete(int id)
    @FXML
    void deleteCustomer(ActionEvent event) {
        // Delete by id
        driv.delete(colId.getCellData(index));
        viewAllRecord();
    }

    // Get table data using CustomerDao getAll()
    void viewAllRecord() {
        // Set all data from getAll into ObservableList<Customer>
        drivers.setAll(driv.getAll());
        tableViewDriver.setItems(drivers);
    }

    public void initialize() {
        // Initialize Table Column
        colId.setCellValueFactory(new PropertyValueFactory<Driver, Integer>("id_driver"));
        colNama.setCellValueFactory(new PropertyValueFactory<Driver, String>("nama_driver"));
        colPlatNo.setCellValueFactory(new PropertyValueFactory<Driver, String>("plat_nomor_driver"));

        viewAllRecord();
    }

    @FXML
    private Button goToTransaksi;
    //Ganti scene
    @FXML
    public void nextToTransaksi(ActionEvent event) throws IOException {
        Parent transaksi = FXMLLoader.load(getClass().getResource("transaksi.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Transaksi");
        window.setScene(new Scene(transaksi));
        window.show();
    }

    @FXML
    private Button goToPenyediaBarang;
    //Ganti scene
    @FXML
    public void backToPenyediaBarang(ActionEvent event) throws IOException {
        Parent penyediaBarang = FXMLLoader.load(getClass().getResource("penyediabarang.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Penyedia Barang");
        window.setScene(new Scene(penyediaBarang));
        window.show();
    }
}
