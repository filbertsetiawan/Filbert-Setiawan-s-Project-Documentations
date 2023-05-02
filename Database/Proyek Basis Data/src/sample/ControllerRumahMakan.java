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

public class ControllerRumahMakan {
    @FXML
    private TableView<RumahMakan> tableViewRumahMakan; // <Object>
    @FXML
    private TableColumn<RumahMakan, Integer> colId; // <Object, DataType>
    @FXML
    private TableColumn<RumahMakan, String> colNama;
    @FXML
    private TableColumn<RumahMakan, String> colAlamat;
    @FXML
    private TableColumn<RumahMakan, String> colNoTelp;
    @FXML
    private TextField txtNama;
    @FXML
    private TextField txtAlamat;
    @FXML
    private TextField txtNoTelp;

    private static final Dao<RumahMakan, Integer> rum = new RumahMakanDao();

    private ObservableList<RumahMakan> rumahMakans = FXCollections.observableArrayList();

    private Integer index;

    // Add new data using CustomerDao add(Customer customer)
    @FXML
    void addCustomer(ActionEvent event) {
        RumahMakan rumahMakan = new RumahMakan(0, txtNama.getText(), txtAlamat.getText(), txtNoTelp.getText());
        rum.add(rumahMakan).ifPresent(rumahMakan::setId_rumah_makan);
        viewAllRecord();
    }

    @FXML
    void getSelected(MouseEvent event) {
        // Get Index of the Selected Row
        index = tableViewRumahMakan.getSelectionModel().getSelectedIndex();
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
        RumahMakan rumahMakan = new RumahMakan(colId.getCellData(index), txtNama.getText(), txtAlamat.getText(), txtNoTelp.getText());
        rum.update(rumahMakan);
        viewAllRecord();
    }

    // Delete selected row data using CustomerDao delete(int id)
    @FXML
    void deleteCustomer(ActionEvent event) {
        // Delete by id
        rum.delete(colId.getCellData(index));
        viewAllRecord();
    }

    // Get table data using CustomerDao getAll()
    void viewAllRecord() {
        // Set all data from getAll into ObservableList<Customer>
        rumahMakans.setAll(rum.getAll());
        tableViewRumahMakan.setItems(rumahMakans);
    }

    public void initialize() {
        // Initialize Table Column
        colId.setCellValueFactory(new PropertyValueFactory<RumahMakan, Integer>("id_rumah_makan"));
        colNama.setCellValueFactory(new PropertyValueFactory<RumahMakan, String>("nama_rumah_makan"));
        colAlamat.setCellValueFactory(new PropertyValueFactory<RumahMakan, String>("alamat_rumah_makan"));
        colNoTelp.setCellValueFactory(new PropertyValueFactory<RumahMakan, String>("no_telp_rumah_makan"));

        viewAllRecord();
    }

    @FXML
    private Button goToCustomer;
    //Ganti scene
    @FXML
    public void backToCustomer(ActionEvent event) throws IOException {
        Parent customer = FXMLLoader.load(getClass().getResource("customer.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Customer");
        window.setScene(new Scene(customer));
        window.show();
    }

    @FXML
    private Button goToPenyediaBarang;
    //Ganti scene
    @FXML
    public void nextToPenyediaBarang(ActionEvent event) throws IOException {
        Parent penyediaBarang = FXMLLoader.load(getClass().getResource("penyediabarang.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Penyedia Barang");
        window.setScene(new Scene(penyediaBarang));
        window.show();
    }
}
