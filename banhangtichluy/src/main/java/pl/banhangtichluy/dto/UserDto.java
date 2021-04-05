package pl.banhangtichluy.dto;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;

import javax.persistence.Column;
import javax.validation.constraints.Email;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.Size;

public class UserDto {

    @JsonProperty("id")
    private String id;

    @NotBlank(message = "username is required")
    @Size(min = 4, max = 20, message = "length of username must be greater or equal 4 and less than or equal 20")
    @JsonProperty("username")
    private String username;

    @NotBlank(message = "password is required")
    @Size(min = 6, max = 20, message = "length of password must be greater or equal 8 and less than or equal 20")
    @JsonProperty("password")
    private String password;

    @NotBlank(message = "firstName is required")
    @JsonProperty("firstName")
    private String firstName;

    @NotBlank(message = "lastName is required")
    @JsonProperty("lastName")
    private String lastName;

    @Email(message = "email should be valid")
    @JsonProperty("email")
    private String email;

    @JsonProperty("phone")
    private String phone;

    @JsonProperty("note")
    private String note;

}
