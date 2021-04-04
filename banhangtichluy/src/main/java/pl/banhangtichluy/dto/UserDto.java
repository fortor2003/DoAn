package pl.banhangtichluy.dto;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;

import javax.persistence.Column;
import javax.validation.constraints.Email;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.Size;

public class UserDto {

    @NotBlank(message = "username is required")
    @Size(min = 4, max = 20, message = "length of username must be greater or equal 4 and less than or equal 20")
    private String username;

    @NotBlank(message = "password is required")
    @Size(min = 6, max = 20, message = "length of password must be greater or equal 8 and less than or equal 20")
    private String password;

    @NotBlank(message = "firstName is required")
    private String firstName;

    @NotBlank(message = "lastName is required")
    private String lastName;

    @Email(message = "email should be valid")
    private String email;

    private String phone;

}
