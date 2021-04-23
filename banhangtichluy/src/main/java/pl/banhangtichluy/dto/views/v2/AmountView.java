package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.annotations.QueryProjection;
import com.querydsl.core.types.*;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.*;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QUser;
import pl.banhangtichluy.entity.User;

import java.util.Date;

@Data
@SuperBuilder
@NoArgsConstructor
@EqualsAndHashCode(callSuper = true)
@ApiModel(value = "AmountView", description = "Detailed information of amount")
public class AmountView extends AmountBaseView {

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, example = "Laurence")
    private String firstName;

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, example = "Aufderhar")
    private String lastName;

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, example = "aurence@example.com")
    private String email;

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, example = "(698) 800-0063")
    private String phone;

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, example = "Example note")
    private String note;

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, example = "2020-08-13 14:30:00")
    private Date createdAt;

    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, example = "2020-10-20 08:10:50")
    private Date updatedAt;

    private UserBaseView createdBy;

    private UserBaseView updatedBy;

    private static final QAmount qAmount = QAmount.amount;

    public static final MappingProjection<AmountView> PROJECTIONS = new MappingProjection<AmountView>(
            AmountView.class,
            qAmount.id, qAmount.type, qAmount.code, qAmount.value, qAmount.firstName, qAmount.lastName, qAmount.email, qAmount.phone, qAmount.note, qAmount.createdAt, qAmount.updatedAt,
            qAmount.createdBy.id, qAmount.createdBy.username, qAmount.createdBy.firstName, qAmount.createdBy.lastName,
            qAmount.updatedBy.id, qAmount.updatedBy.username, qAmount.updatedBy.firstName, qAmount.updatedBy.lastName
    ) {
        @Override
        protected AmountView map(Tuple row) {
            return AmountView.builder()
                    .id(row.get(qAmount.id))
                    .type(row.get(qAmount.type))
                    .code(row.get(qAmount.code))
                    .value(row.get(qAmount.value))
                    .firstName(row.get(qAmount.firstName))
                    .lastName(row.get(qAmount.lastName))
                    .email(row.get(qAmount.email))
                    .phone(row.get(qAmount.phone))
                    .note(row.get(qAmount.note))
                    .createdAt(row.get(qAmount.createdAt))
                    .updatedAt(row.get(qAmount.updatedAt))
                    .createdBy(
                            row.get(qAmount.createdBy.id) != null
                                    ? UserBaseView.builder()
                                    .id(row.get(qAmount.createdBy.id))
                                    .username(row.get(qAmount.createdBy.username))
                                    .firstName(row.get(qAmount.createdBy.firstName))
                                    .lastName(row.get(qAmount.createdBy.lastName))
                                    .build()
                                    : null
                    )
                    .updatedBy(
                            row.get(qAmount.updatedBy.id) != null
                                    ? UserBaseView.builder()
                                    .id(row.get(qAmount.updatedBy.id))
                                    .username(row.get(qAmount.updatedBy.username))
                                    .firstName(row.get(qAmount.updatedBy.firstName))
                                    .lastName(row.get(qAmount.updatedBy.lastName))
                                    .build()
                                    : null
                    )
                    .build();
        }
    };
}
