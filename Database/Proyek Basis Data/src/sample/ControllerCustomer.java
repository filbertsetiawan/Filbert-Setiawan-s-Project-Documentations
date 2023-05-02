package sample;

import DBConnection.Customer;
import DBConnection.Dao;
import DBConnection.CustomerDao;
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


public class ControllerCustomer {
    @FXML
    private TableView<Customer> tableViewCustomers; // <Object>
    @FXML
    private TableColumn<Customer, Integer> colId; // <Object, DataType>
    @FXML
    private TableColumn<Customer, String> colNama;
    @FXML
    private TableColumn<Customer, String> colAlamat;
    @FXML
    private TableColumn<Customer, String> colNoTelp;
    @FXML
    private TextField txtNama;
    @FXML
    private TextField txtAlamat;
    @FXML
    private TextField txtNoTelp;

    private static final Dao<Customer, Integer> cust = new CustomerDao();

    private ObservableList<Customer> customers = FXCollections.observableArrayList();

    private Integer index;

    // Add new data using CustomerDao add(Customer customer)
    @FXML
    void addCustomer(ActionEvent event) {
        Customer customer = new Customer(0, txtNama.getText(), txtAlamat.getText(), txtNoTelp.getText());
        cust.add(customer).ifPresent(customer::setId_customer);
        viewAllRecord();
    }

    @FXML
    void getSelected(MouseEvent event) {
        // Get Index of the Selected Row
        index = tableViewCustomers.getSelectionModel().getSelectedIndex();
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
        Customer customer = new Customer(colId.getCellData(index), txtNama.getText(), txtAlamat.getText(), txtNoTelp.getText());
        cust.update(customer);
        viewAllRecord();
    }

    // Delete selected row data using CustomerDao delete(int id)
    @FXML
    void deleteCustomer(ActionEvent event) {
        // Delete by id
        cust.delete(colId.getCellData(index));
        viewAllRecord();
    }

    // Get table data using CustomerDao getAll()
    void viewAllRecord() {
        // Set all data from getAll into ObservableList<Customer>
        customers.setAll(cust.getAll());
        tableViewCustomers.setItems(customers);
    }

    public void initialize() {
        // Initialize Table Column
        colId.setCellValueFactory(new PropertyValueFactory<Customer, Integer>("id_customer"));
        colNama.setCellValueFactory(new PropertyValueFactory<Customer, String>("nama_customer"));
        colAlamat.setCellValueFactory(new PropertyValueFactory<Customer, String>("alamat_customer"));
        colNoTelp.setCellValueFactory(new PropertyValueFactory<Customer, String>("no_telp_customer"));

        viewAllRecord();
    }


    @FXML
    private Button goToRumahMakan;
    //Ganti scene
    @FXML
    public void nextToRumahMakan(ActionEvent event) throws IOException {
        Parent rumahMakan = FXMLLoader.load(getClass().getResource("rumahmakan.fxml"));
        Stage window = (Stage) ((Node)event.getSource()).getScene().getWindow();
        window.setTitle("Rumah Makan");
        window.setScene(new Scene(rumahMakan));
        window.show();
    }
}
