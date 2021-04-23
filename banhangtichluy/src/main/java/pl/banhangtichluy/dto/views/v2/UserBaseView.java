package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.annotations.QueryProjection;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;

@Data
@SuperBuilder
@NoArgsConstructor
@ApiModel(value = "UserBaseView", description = "Basic information of user")
public class UserBaseView {

    @ApiModelProperty(name = "id", notes = EntityPropsDescriptionConstant.UserProps.ID, example = "100")
    private Long id;

    @ApiModelProperty(name = "username", notes = EntityPropsDescriptionConstant.UserProps.USERNAME, example = "dustyemmerich")
    private String username;

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.UserProps.FIRST_NAME, example = "Fredric")
    private String firstName;

    @ApiModelProperty(name = "lastName", notes = EntityPropsDescriptionConstant.UserProps.LAST_NAME, example = "Mitchell")
    private String lastName;

}
