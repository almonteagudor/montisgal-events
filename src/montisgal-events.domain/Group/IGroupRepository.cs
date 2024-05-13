namespace montisgal_events.domain.Group;

public interface IGroupRepository
{
    public Task<Group?> GetGroup(Guid id, Guid ownerId);
    
    public Task<List<Group>> GetGroups(Guid ownerId);

    public Task<Group?> InsertGroup(Group group);
    
    public Task<Group?> UpdateGroup(Group group);
    
    public Task<bool> DeleteGroup(Group group);
}