package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.annotations.QueryProjection;
import com.querydsl.core.types.*;
import lombok.*;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.entity.QAmount;
import pl.banhangtichluy.entity.QUser;
import pl.banhangtichluy.entity.User;

import java.util.Date;

@Data
@SuperBuilder
@NoArgsConstructor
@EqualsAndHashCode(callSuper = true)
public class AmountView extends AmountBaseView {

    private String firstName;
    private String lastName;
    private String email;
    private String phone;
    private String note;
    private Date createdAt;
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
