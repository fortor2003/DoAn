package pl.banhangtichluy.dto.response;

import com.fasterxml.jackson.annotation.JsonProperty;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.Builder;
import lombok.Data;

@Data
@Builder
@ApiModel(value = "BadRequestDto", description = "Information used to response fields is not valid of form")
public class BadRequestDto {

    @JsonProperty("field")
    @ApiModelProperty(name = "field", notes = "name of field", example = "email")
    private String field;

    @JsonProperty("message")
    @ApiModelProperty(name = "message", notes = "Error message", example = "Email is not valid")
    private String message;
}
