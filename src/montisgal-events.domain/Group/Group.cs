using montisgal_events.domain.Group.ValueObjects;

namespace montisgal_events.domain.Group;

public class Group
{
    internal Group(Guid id, GroupName name, GroupDescription description, GroupVisibility groupVisibility, Guid ownerId)
    {
        Id = id;
        Name = name;
        Description = description;
        GroupVisibility = groupVisibility;
        OwnerId = ownerId;
    }

    public Guid Id { get; }
    public GroupName Name { get; set; }
    public GroupDescription Description { get; set; }
    public GroupVisibility GroupVisibility { get; set; }
    public Guid OwnerId { get; }
}