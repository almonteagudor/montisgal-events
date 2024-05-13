using montisgal_events.domain.User.ValueObjects;

namespace montisgal_events.domain.User;

public class User(Guid id, UserName name)
{
    public Guid Id { get; set; } = id;
    public UserName Name { get; set; } = name;
}