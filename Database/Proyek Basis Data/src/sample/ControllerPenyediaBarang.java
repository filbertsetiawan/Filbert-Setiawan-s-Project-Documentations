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

public class ControllerPenyediaBarang {
    @FXML
    private TableView<PenyediaBarang> tableViewPenyediaBarang; // <Object>
    @FXML
    private TableColumn<PenyediaBarang, Integer> colId; // <Object, DataType>
    @FXML
    private TableColumn<PenyediaBarang, String> colNama;
    @FXML
    private TableColumn<PenyediaBarang, String> colAlamat;
    @FXML
    private TableColumn<PenyediaBarang, String> colNoTelp;
    @FXML
    private TextField txtNama;
    @FXML
    private TextField txtAlamat;
    @FXML
    private TextField txtNoTelp;

    private static final Dao<PenyediaBarang, Integer> peny = new PenyediaBarangDao();

    private ObservableList<PenyediaBarang> penyediaBarangs = FXCollections.observableArrayList();

    private Integer index;

    // Add new data using CustomerDao add(Customer customer)
    @FXML
    void addCustomer(ActionEvent event) {
        PenyediaBarang penyediaBarang = new PenyediaBarang(0, txtNama.getText(), txtAlamat.getText(), txtNoTelp.getText());
        peny.add(penyediaBarang).ifPresent(penyediaBarang::setId_penyedia_barang);
        viewAllRecord();
    }

    @FXML
    void getSelected(MouseEvent event) {
        // Get Index of the Selected Row
        index = tableViewPenyediaBarang.getSelectionModel().getSelectedIndex();
        // Out of bound checking
        if (index <= -1) {
            return;
        }

        // Fill textField with Customer Data
        txtNama.setText(colNama.getCellData(index));
        txtAlamat.setText(colAlamat.getCellData(index));
        txtNoTelp.setText(colNoTelp.getCellData(index).toString());
    }

    // Update selected row data using CustomerDao update(Customer customer)
    @FXML
    void updateCustomer(ActionEvent event) {
        // Update by id, value from TextView
        PenyediaBarang penyediaBarang = new PenyediaBarang(colId.getCellData(index), txtNama.getText(), txtAlamat.getText(), txtNoTelp.getText());
        peny.update(penyediaBarang);
        viewAllRecord();
    }

    // Delete selected row data using CustomerDao delete(int id)
    @FXML
    void deleteCustomer(ActionEvent event) {
        // Delete by id
        peny.delete(colId.getCellData(index));
        viewAllRecord();
    }

    // Get table data using CustomerDao getAll()
    void viewAllRecord() {
        // Set all data from getAll into ObservableList<Customer>
        penyediaBarangs.setAll(peny.getAll());
        tableViewPenyediaBarang.setItems(penyediaBarangs);
    }

    public void initialize() {
        // Initialize Table Column
        colId.setCellValueFactory(new PropertyValueFactory<PenyediaBarang, Integer>("id_penyedia_barang"));
        colNama.setCellValueFactory(new PropertyValueFactory<PenyediaBarang, String>("nama_penyedia_barang"));
        colAlamat.setCellValueFactory(new PropertyValueFactory<PenyediaBarang, String>("alamat_penyedia_barang"));
        colNoTelp.setCellValueFactory(new PropertyValueFactory<PenyediaBarang, String>("no_telp_penyedia_barang"));

        viewAllRecord();
    }

    @FXML
    private Button goToRumahMakan;
    //Ganti scene
    @FXML
    public void backToRumahMakan(ActionEvent event) throws IOException {
        Parent rumahMakan = FXMLLoader.load(getClass().getResource("rumahmakan.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Rumah Makan");
        window.setScene(new Scene(rumahMakan));
        window.show();
    }

    @FXML
    private Button goToDriver;
    //Ganti scene
    @FXML
    public void nextToDriver(ActionEvent event) throws IOException {
        Parent driver = FXMLLoader.load(getClass().getResource("driver.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Driver");
        window.setScene(new Scene(driver));
        window.show();
    }
}
